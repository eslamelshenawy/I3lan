<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with('service_en')->get();
        $projects =  Project::with('project_en')->get();
        return view('dashboard.project.campaign', compact('services', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::with('service_en')->get();
        return view('dashboard.project.create', compact('services'));

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
            'client'            => 'bail|required|max:200',
            'description_en'    => 'bail|required',
            'service_id'        => 'bail|required',
            'image_id'          => 'bail|required|mimes:jpeg,jpg,png,gif',
        ], [], [
            'title_en'          => ' Title in English',
            'description_en'    => ' Description in English',
            'name_en'           => ' Name in English',
            'image_id'          => ' Image',
            'service_id'        => ' Project Related Service',
        ]);

        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/project', $fileName);
            $filePath = 'dashboardImages/project/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
        }

        $project = new Project();
        $project->image_id = $input['image_id'];
        $project->service_id = $input['service_id'];
        $project->created_by = $input['created_by'];
        $project->display = $input['display'];
        $project->save();

        try
        {
            if ($request->hasFile('images'))
            {
                $images = array();
                foreach ($request->images as $image) {

                    $name =  time() . $image->getClientOriginalName();

                    $image->move('dashboardImages/project', $name);

                    $path = 'dashboardImages/project/' .$name;

                    $image = Image::create(['name' => $name, 'path' => $path]);

                    /*$input['image_id'] = $image->id;*/

                    array_push($images, $image->id);
                }
            }
        }

        catch (\Exception $e)
        {
            Session::flash('exception', 'Can\'t Add Images To Album');
            return redirect(adminUrl('project'));
        }

        $project->images()->attach($images);
        $project->project_en()->create(['project_id' => $project->id, 'name' => $request->name_en, 'client' => $request->client, 'description' => $request->description_en]);

        Session::flash('create', 'Project Has Been Created Successfully');
        return redirect(adminUrl('project'));
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
        $services = Service::with('service_en')->get();
        $project = Project::with('project_en')->find($id);
        return view('dashboard.project.edit', compact('services', 'project'));
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
        $project = Project::with('project_en')->find($id);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'name_en'           => 'bail|required|max:200',
            'client'            => 'bail|required|max:200',
            'description_en'    => 'bail|required',
            'service_id'        => 'bail|required',
            'image_id'          => 'bail|mimes:jpeg,jpg,png,gif',
        ], [], [
            'title_en'          => ' Title in English',
            'description_en'    => ' Description in English',
            'name_en'           => ' Name in English',
            'image_id'          => ' Image',
            'service_id'        => ' Project Related Service',
        ]);

        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/project', $fileName);
            $filePath = 'dashboardImages/project/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
            $project->image_id = $input['image_id'];
        }

        $project->service_id = $input['service_id'];
        $project->created_by = $input['created_by'];
        $project->display = $input['display'];
        $project->save();

        try
        {
            if ($request->hasFile('images'))
            {
                $images = array();
                foreach ($request->images as $image) {

                    $name =  time() . $image->getClientOriginalName();

                    $image->move('dashboardImages/project', $name);

                    $path = 'dashboardImages/project/' .$name;

                    $image = Image::create(['name' => $name, 'path' => $path]);

                    /*$input['image_id'] = $image->id;*/

                    array_push($images, $image->id);

                }
                $project->images()->attach($images);
            }
        }

        catch (\Exception $e)
        {
            Session::flash('exception', 'Can\'t Add Images To Album');
            return redirect(adminUrl('project'));
        }


        $project->project_en()->update(['name' => $request->name_en, 'client' => $request->client, 'description' => $request->description_en]);

        Session::flash('create', 'Project Has Been Updated Successfully');
        return redirect(adminUrl('project'));
    }

    public function projectImages($id)
    {
        $project = Project::with('images')->find($id);
        return view('dashboard.project.images', compact('project'));
    }


    public function deleteImage($id)
    {
        //$service = Service::with('images')->find($id);
        DB::table('project_images')->where('image_id', $id)->delete();
        DB::table('image')->where('id', $id)->delete();
        Session::flash('delete', 'Service Image Has Been Deleted Successfully');
        return redirect()->back();
    }






    public function destroy($id)
    {
        $project = Project::with('image')->find($id);
        $project->images()->detach();
        $project->delete();

        try
        {
            if ($project->image_id)
            {
                unlink(public_path() . '/' . $project->image->path);
                DB::table('image')->where('id', $project->image_id)->delete();
            }
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Project Because The Slide is related to another table');
            return redirect()->back();
        }

        Session::flash('delete', 'Project Has Been Deleted Successfully');
        return redirect(adminUrl('project'));
    }
}
