<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Image;
use App\Models\Service;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$type = Input::get('type');
        if ($type == 'main')
        {

        }
        else if ($type == 'sub')
        {
            $services = Service::with('service_en', 'createdBy', 'image')->where('parent_service_id', '!=', null)->get();
            return view('dashboard.service.subService', compact('services'));
        }*/
        $services = Service::with('service_en', 'createdBy', 'image')->where('parent_service_id', null)->get();
        return view('dashboard.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.service.create');
    }

    public function storeSub(Request $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'title_en'          => 'bail|required|max:200',
            'service_id'        => 'bail|required|int|max:200',
            'description_en'    => 'bail|required',
            'image_id'          => 'bail|mimes:jpeg,jpg,png,gif',
        ], [], [
            'title_en'          => ' Title in English',
            'description_en'    => ' Description in English',
            'image_id'          => ' Image',
        ]);


        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/service', $fileName);
            $filePath = 'dashboardImages/service/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
        }


        if (isset($input['video_url']))
        {
            $video = new Video();
            $video->url = $input['video_url'];
            $video->save();
        }

        else
        {
            $service = new Service();
            $service->image_id = $request->image_id;
            $service->created_by = $input['created_by'];
            $service->icon_code = $input['icon_code'];
            $service->parent_service_id = $input['service_id'];
            $service->save();

            $service->service_en()->create(['service_id' => $service->id, 'title' => $input['title_en'], 'description' => $input['description_en']]);
        }

        //$service->video()->create(['url' => $input['url']]);

        Session::flash('create', 'Service  Has Been Created Successfully');
        return redirect(adminUrl('service/'.$input['service_id']));
    }


    public function createSubService($id)
    {
        $service = Service::with('image', 'service_en', 'createdBy')->find($id);
        return view('dashboard.service.createSub', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'title_en'          => 'bail|required|max:200',
            'description_en'    => 'bail|required',
            'image_id'          => 'bail|required|mimes:jpeg,jpg,png,gif',
        ], [], [
            'title_en'          => ' Title in English',
            'description_en'    => ' Description in English',
            'image_id'          => ' Image',
        ]);


        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/service', $fileName);
            $filePath = 'dashboardImages/service/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
        }

        if (isset($input['video_url']))
        {
            $video = new Video();
            $video->url = $input['video_url'];
            $video->save();
        }


        $service = new Service();
        $service->image_id = $input['image_id'];
        $service->icon_code = $input['icon_code'];
        $service->created_by = $input['created_by'];
        $service->save();

        $service->service_en()->create(['service_id' => $service->id, 'title' => $input['title_en'], 'description' => $input['description_en']]);

        Session::flash('create', 'Service  Has Been Created Successfully');
        return redirect(adminUrl('service'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mainService =  Service::with('image', 'service_en', 'createdBy')->find($id);
        $services = Service::with('image', 'service_en', 'createdBy')->where('parent_service_id', $id)->get();
        return view('dashboard.service.subService', compact('services', 'mainService'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::with('image', 'service_en', 'createdBy')->find($id);
        return view('dashboard.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $service = Service::with('service_en', 'createdBy', 'image')->find($id);
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'title_en'          => 'bail|required|max:200',
            'description_en'    => 'bail|required',
            'image_id'          => 'mimes:jpeg,jpg,png,gif',
        ], [], [
            'title_en'          => ' Title in English',
            'description_en'    => ' Description in English',
            'image_id'          => ' Image',
        ]);

        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/slider', $fileName);
            $filePath = 'dashboardImages/slider/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
            $service->image_id = $input['image_id'];
        }

        if (isset($input['video_url']))
        {
            $video = Video::find($service->video_id);
            if ($video)
            {
                $video->url = $input['video_url'];
                $video->save();
            }
            else
            {
                $video = new Video();
                $video->url = $input['video_url'];
                $video->save();
                $service->video_id = $video->id;
            }
        }

        $service->created_by = $input['created_by'];
        $service->icon_code = $input['icon_code'];
        $service->save();

        $service->service_en()->update(['service_id' => $service->id, 'title' => $input['title_en'], 'description' => $input['description_en']]);

        Session::flash('update', 'Service Has Been Updated Successfully');
        return redirect(adminUrl('service'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);


        try{
            $service->delete();
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Service Because There is sub service related');
            return redirect()->back();
        }

        try
        {
            if ($service->image_id)
            {
                unlink(public_path() . '/' . $service->image->path);
                DB::table('image')->where('id', $service->image_id)->delete();
            }
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Slide Because The Slide is related to another table');
            return redirect()->back();
        }

        Session::flash('delete', 'Service ' . $service->id . ' Has Been Deleted Successfully');
        return redirect(adminUrl('service'));
    }
}
