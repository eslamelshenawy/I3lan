<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Billboard;
use App\Models\Campaign_item;
use App\Models\Child_location;
use App\Models\Child_of_child_location;
use App\Models\Client;
use App\Models\English\ServiceEnglish;
use App\Models\Feature;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\Image;
use App\Models\Message;
use App\Models\Product;
use App\Models\Parent_location;
use App\Models\About;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Size;
use App\Models\Slider;
use App\Models\Campaign;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class WebsitePagesController extends Controller
{

    /* Return Home Page */
    public function index()
    {
        $clients = Client::with('image')->limit(10)->get();
        $services = Service::all();
        $slides = Slider::with('image')->get();
        return view('website.welcome', compact('services','clients', 'slides'));
    }

    /* Return search Page */
    public function search(Request $request)
    {
        $locations = Parent_location::with('parentLocation_en')->get();
        $sizes = Size::all();
        $billboards = array();
        $Child_location = \App\Models\English\Child_location::where('location','LIKE' ,'%'.$request['search'].'%')->get(['child_location_id']);
        foreach ($Child_location as $c ){
            $billboard = Billboard::with('billboard_en', 'type', 'image')->where('child_location_id', '=', $c->child_location_id)->get();
            foreach ($billboard as $b){
                array_push($billboards, $b);
            }
        }
        $Child_of_child_location = \App\Models\English\Child_of_child_location::where('location','LIKE' ,'%'.$request['search'].'%')->get(['child_of_child_location_id']);
        foreach ($Child_of_child_location as $c ){
            $billboard = Billboard::with('billboard_en', 'type', 'image')->where('child_of_child_location_id', '=', $c->child_of_child_location_id)->get();
            foreach ($billboard as $b){
                array_push($billboards, $b);
            }
        }

        $name = \App\Models\English\Billboard::where('name', 'LIKE' ,'%'.$request['search'].'%')->get(['billboard_id']);
        foreach ($name as $n ){
            $billboard = Billboard::with('billboard_en', 'type', 'image')->where('id', '=', $n->billboard_id)->get();
            foreach ($billboard as $b){
                array_push($billboards, $b);
            }
        }

        $billboard = Billboard::with('billboard_en', 'type', 'image')->where('material','LIKE' ,'%'.$request['search'].'%' )
            ->orwhere('light','LIKE' ,'%'.$request['search'].'%')
            ->orwhere('faces','LIKE' ,'%'.$request['search'].'%')
            ->orwhere('code','LIKE' ,'%'.$request['search'].'%')->get();
        foreach ($billboard as $b){
            array_push($billboards, $b);
        }

        $billboard = Billboard::with('billboard_en', 'type', 'image')->whereHas('type', function ($query) use ($request) {
                $query->where('type','LIKE' ,'%'.$request['search'].'%');
            })->get();
        foreach ($billboard as $b){
            array_push($billboards, $b);
        }

        $billboard = Billboard::with('billboard_en', 'type', 'image')->whereHas('size', function ($query) use ($request) {
            $query->where('size','LIKE' ,'%'.$request['search'].'%');
        })->get();
        foreach ($billboard as $b){
            array_push($billboards, $b);
        }

        $service = ServiceEnglish::where('title','LIKE' ,'%'.$request['search'].'%')->get();
        foreach ($service as $s ){
            $billboard = Billboard::with('billboard_en', 'type', 'image')->where('service_id', '=', $s->service_id)->get();
            foreach ($billboard as $b){
                array_push($billboards, $b);
            }
        }
        $billboards = array_unique($billboards);


//        $billboards = Billboard::with('billboard_en', 'type', 'image')->whereHas('childLocation', function ($query) use ($request) {
//            $query->whereHas('childLocation_en', function ($query) use ($request) {
//                $query->where('location','LIKE' ,$request['search']);
//            });
//        })->orwhereHas('childOfChildLocation', function ($query) use ($request) {
//            $query->whereHas('childOfChildLocation_en', function ($query) use ($request) {
//                $query->where('location','LIKE' ,$request['search']);
//            });
//        })->get();
        $authUser = Auth::user();
        if ($authUser)
        {
            return view('website.search', compact('billboards','locations', 'sizes'));
        }
        else
        {
            return redirect('login/customer');
        }
    }

    /* Return About Page */
    public function about()
    {
        $about = About::with('about_en', 'about_ar', 'missionImage', 'visionImage', 'valuesImage')->orderBy('created_at', 'desc')->first();
        // dd($about);
        return view('website.about',compact('about'));
    }

    /* Return Contact Page */
    public function contact()
    {
        $contact = Contact::orderby('id', 'desc')->first();
        return view('website.contact', compact('contact'));
    }

    /* Return Client Page */
    public function client()
    {
        $clients = Client::with('image')->get();
        return view('website.client', compact('clients'));
    }


    /* Return Service Page */
    public function service()
    {
        $parentService = Input::get('parentService');
        $childService = Input::get('childService');
        if (!empty($parentService))
        {
            $billboards = Billboard::with('billboard_en', 'type', 'image')->where('service_id', $parentService)->orderBy('created_at', 'desc')->paginate(9);
        }
        elseif (!empty($childService))
        {
            $billboards = Billboard::with('billboard_en', 'type', 'image')->where('sub_service_id', $childService)->orderBy('created_at', 'desc')->paginate(9);
        }
        else
        {
            $billboards = Billboard::with('billboard_en', 'type', 'image')->orderBy('created_at', 'desc')->paginate(9);
        }
        $locations = Parent_location::with('parentLocation_en')->get();
        $sizes = Size::all();
        return view('website.services', compact('billboards','locations', 'sizes'));
    }

    /* Return Service Details Page */
    public function service_details($id)
    {
        $billboard = Billboard::with('billboard_en', 'type', 'image')->find($id);
        return view('website.services_details', compact('billboard'));
    }


    /* Return Send Message Page */
    public function message(Request $request)
    {
        $message = new Message;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->Phone;
        $message->title = $request->subject;
        $message->message = $request->message;
        $message->phone = 1;

        $message->save();
        return redirect()->back()->with('message', 'We Will Contact you within two days ');

    }


    public function add_buildCamp($id, Request $request)
    {
        dd($request);
        $services = Service::with('service_en', 'createdBy', 'image')->where('id', $id)->first();
        return view('website.services_details', compact('services'));
    }


    public function buildCamp()
    {

        /*$parentLocationId = Input::get('parentLocation');
        $childLocationId = Input::get('childLocation');
        $childOfChildLocation = Input::get('childOfChildLocation');
        $sizeId = Input::get('size');

        $mainQuery = Billboard::with('billboard_en');
        $parentQuery = '';
        if (!empty($parentLocationId))
        {
            $parentQuery .= 'where(\'parent_location_id\', $parentLocationId)->get()';
            $billboards = $mainQuery->{$parentQuery};
        }
        elseif (!empty($childLocationId))

        $billboards = Billboard::with('billboard_en')
            ->where('parent_location_id', $parentLocationId)
            ->where('child_location_id', $childLocationId)
            ->where('child_of_child_location_id', '=', '*')
            ->get();*/

        $locations = Parent_location::with('parentLocation_en')->get();
        $sizes = Size::all();
        $billboards = Billboard::with('billboard_en', 'type', 'image')->get();
        $authUser = Auth::user();
        if ($authUser)
        {
            return view('website.buildCamp', compact('billboards','locations', 'sizes'));
        }
        else
        {
            return redirect('login/customer');
        }

    }

    /**
     * Add Bill Board To Next Campaign
     */
    public function addToCampaign(Request $request)
    {
        $userId = Auth::user()->id;
        $billboardId = \request('code');
        $campaign = Campaign::with('campaignDetails')
            ->where('user_id', $userId)
            ->where('status', 1)
            ->first();

        //check if campaign exist
        if ($campaign)
        {
            $isCampaignItem = Campaign_item::where('billboard_id', $billboardId)->where('campaign_id', $campaign->id)->first();
            if ($isCampaignItem)
            {
                return redirect()->back()->with('exception', 'Item Already Added To Your Campaign Before, Please Complete Your Campaign Info');
            }
            else
            {
                $campaignItem = new Campaign_item();
                $campaignItem->billboard_id = $billboardId;
                $campaignItem->campaign_id = $campaign->id;
                // $campaignItem->starts = \request('from');
                // $campaignItem->end = \request('to');
                $campaignItem->save();
            }
        }
        else
        {
            $newCampaign = new Campaign();
            $newCampaign->user_id = $userId;
            $newCampaign->status = 1;
            $newCampaign->save();

            $newCampaign->campaignDetails()->create(['campaign_id' => $newCampaign->id]);

            $campaignItem = new Campaign_item();
            $campaignItem->billboard_id = $billboardId;
            $campaignItem->campaign_id = $newCampaign->id;
            // $campaignItem->starts = \request('from');
            // $campaignItem->end = \request('to');
            $campaignItem->save();
        }

        return redirect()->back()->with('create', 'Item Added To Your Campaign Successfully, Please Complete Your Campaign Info');

    }

    /**
     * Add Requested Items and Checkout
     */
    public function showRequestedItems()
    {
        $authUser = Auth::user();
        if ($authUser)
        {
            $userId = Auth::user()->id;
            $requestedCampaign = Campaign::with('billboard')->where('user_id', $userId)->where('status', 1)->first();
            return view('website.requestedItems', compact('requestedCampaign'));
        }
        else
        {
            return redirect('login/customer');
        }
    }


    /**
     * Save Request
     */
    public function submitCampaignRequest(Request $request)
    {
        $this->validate($request,[
            'company_name'  => 'required|max:100',
            'position'      => 'required|max:50',
            'phone'         => 'required|min:8|max:20',
            'camp_name'     => 'required|max:100',
        ], [], [
            'camp_name'     => 'Campaign Name',
        ]);

        $userId = Auth::user()->id;
        $requestedCampaign = Campaign::with('billboard')->where('user_id', $userId)->where('status', 1)->first();
        $requestedCampaign->status = 2;
        $requestedCampaign->save();

        $requestedCampaign->campaignDetails()->update([
            'company' => \request('company_name'),
            'phone' => \request('phone'),
            'position' => \request('position'),
            'name' => \request('camp_name')
        ]);

        return redirect('my-campaigns')->with('create', 'Your Campaign Submitted Successfully');

    }

    /**
     * Show My Last Campaigns
     */
    public function myCampaigns()
    {
        $authUser = Auth::user();
        if ($authUser)
        {
            $campaigns = Campaign::with('campaignDetails')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            return view('website.myCampaigns', compact('campaigns'));        }
        else
        {
            return redirect('login/customer');
        }
    }

    /**
     * Show My Last Campaigns
     */
    public function myCampaigns_details()
    {
        $authUser = Auth::user();
        if ($authUser)
        {
            $campaigns = Campaign::with('campaignDetails','billboard')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            
                 $list_array=[];
            foreach($campaigns as $campaign ){

            foreach($campaign->billboard as $key=> $billboard){
    
                    $list_array[$key]['address']=$billboard->searchmab;
                    $list_array[$key]['lat']=$billboard->lat;
                    $list_array[$key]['lng']=$billboard->lng;
               
            }

            }
           

    
            return view('website.myCampaigns_details', compact('campaigns','list_array'));        }
        else
        {
            return redirect('login/customer');
        }
    }

    /**
     * Return Child Locations Based on Parent Location Returned from Ajax Request Page
     */
    public function child_location($id)
    {
        $childLocations = Child_location::with('childLocation_en')->where('parent_location_id', $id)->get();
        return response()->json($childLocations);
    }

    /**
     * Return Child of Child Locations Based on Parent Location Returned from Ajax Request Page
     */
    public function child_of_child_location($id)
    {
        $childOfChildLocations = Child_of_child_location::with('childOfChildLocation_en')->where('child_location_id', $id)->get();
        return response()->json($childOfChildLocations);
    }

    public function filter(Request $request)
    {
        $parentLocationId = $request->parent;
        $childLocationId = $request->child;
        $childOfChildLocation = $request->child_of_child;
        $sizeId = \request('size');

        $sizesArray = [];
        if (!empty($sizeId))
        {
            foreach ($sizeId as $size)
            {
                array_push($sizesArray, $size);
            }
        }
        /*$sizeUrl = "";
        if (!empty($sizeId))
        {
            foreach ($sizeId as $size)
            {
                {
                    $sizeUrl .=  $size . "_";
                }
            }
        }

        return redirect('/buildCamp?parentLocation=' . $parentLocationId .
            '&childLocation=' . $childLocationId .
            '&childOfChildLocation=' . $childOfChildLocation .
            '&size=' . $sizeUrl
        );*/


        if ($parentLocationId)
        {
            $billboards = Billboard::with('billboard_en')->where('parent_location_id', $parentLocationId)->get();
        }

        if ($childLocationId)
        {
            $billboards = Billboard::with('billboard_en')->where('child_location_id', $childLocationId)->get();
        }

        if ($childOfChildLocation)
        {
            $billboards = Billboard::with('billboard_en')->where('child_of_child_location_id', $childOfChildLocation)->get();
        }

        if ($sizeId)
        {
            $billboards = Billboard::with('billboard_en')
                ->where('parent_location_id', $parentLocationId)
                ->where('child_location_id', $childLocationId)
                ->where('child_of_child_location_id', $childOfChildLocation)
                ->whereIn('size_id', $sizesArray)
                ->get();
        }


        $locations = Parent_location::with('parentLocation_en')->get();
        $sizes = Size::all();

        return view('website.buildCamp', compact('billboards', 'locations', 'sizes'));
    }


}

























