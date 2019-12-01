<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Team::with('team_en')->get();
        return view('dashboard.team.campaign', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::with('service_en')->where('parent_service_id', null)->get();
        return view('dashboard.team.create', compact('services'));
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
            'name_en'           => 'bail|required|max:200',
            'title_en'          => 'bail|required|max:200',
            'description_en'    => 'bail|required',
            'image_id'          => 'bail|required|mimes:jpeg,jpg,png,gif',
        ], [], [
            'title_en'          => ' Title in English',
            'description_en'    => ' Description in English',
            'name_en'           => ' Name in English',
            'image_id'          => ' Image',
        ]);


        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/team', $fileName);
            $filePath = 'dashboardImages/team/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
        }

        $team = new Team();
        $team->image_id = $input['image_id'];
        $team->created_by = $input['created_by'];
        $team->save();

        $team->team_en()->create(['member_id' => $team->id, 'job_title' => $input['title_en'], 'description' => $input['description_en'], 'name' => $input['name_en']]);

        Session::flash('create', 'Team Member  Has Been Created Successfully');
        return redirect(adminUrl('team'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::with('service_en')->where('parent_service_id', null)->get();
        $member = Team::with('image', 'team_en', 'team_ar', 'createdBy')->find($id);
        return view('dashboard.team.edit', compact('member', 'services'));
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
        $team = Team::with('image', 'team_en', 'createdBy')->find($id);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'name_en'           => 'bail|required|max:200',
            'title_en'          => 'bail|required|max:200',
            'description_en'    => 'bail|required',
            'image_id'          => 'bail|mimes:jpeg,jpg,png,gif',
        ], [], [
            'title_en'          => ' Title in English',
            'description_en'    => ' Description in English',
            'name_en'           => ' Name in English',
            'image_id'          => ' Image',
        ]);


        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/team', $fileName);
            $filePath = 'dashboardImages/team/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
            $team->image_id = $input['image_id'];
        }


        $team->created_by = $input['created_by'];
        $team->save();

        $team->team_en()->update(['member_id' => $team->id, 'job_title' => $input['title_en'], 'description' => $input['description_en'], 'name' => $input['name_en']]);

        Session::flash('create', 'Team Member  Has Been Updated Successfully');
        return redirect(adminUrl('team'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);

        $team->delete();

        try
        {
            if ($team->image_id)
            {
                unlink(public_path() . '/' . $team->image->path);
                DB::table('image')->where('id', $team->image_id)->delete();
            }
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Slide Because The Slide is related to another table');
            return redirect()->back();
        }

        Session::flash('delete', 'Team ' . $team->id . ' Has Been Deleted Successfully');
        return redirect(adminUrl('team'));
    }
}
