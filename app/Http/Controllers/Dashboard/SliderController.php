<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Image;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slider::with('image', 'slider_en', 'createdBy')->get();
        return view('dashboard.slider.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.slider.create');
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
            'url'               => 'bail|max:200',
            'title_en'          => 'bail|required|max:200',
            'button_en'         => 'bail|max:50',
            'image_id'          => 'bail|required|mimes:jpeg,jpg,png,gif',
        ], [], [
            'url'               => ' URL',
            'title_en'          => ' Title in English',
            'button_en'         => ' Button in English',
            'image_id'          => ' Image',
        ]);


        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/slider', $fileName);
            $filePath = uploadedImagePath() . '/slider/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
        }

        //Add Slide in Slider Table in Main Database
        $slide = new Slider();
        $slide->image_id = $input['image_id'];
        $slide->url = $input['url'];
        $slide->created_by = $input['created_by'];
        $slide->save();

        $slide->slider_en()->create(['slide_id' => $slide->id, 'title' => $input['title_en'], 'sub_title' => $input['sub_title'], 'description' => $input['description_en'], 'button' => $input['button_en']]);

        Session::flash('create', 'Slide  Has Been Created Successfully');
        return redirect(adminUrl('slider'));
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
        $slide = Slider::with('image', 'slider_ar', 'slider_en')->find($id);
        return view('dashboard.slider.edit', compact('slide'));
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
        $slide = Slider::with('image', 'slider_ar', 'slider_en')->find($id);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'url'               => 'bail|max:200',
            'title_en'          => 'bail|required|max:200',
            'button_en'         => 'bail|max:50',
            'image_id'          => 'mimes:jpeg,jpg,png,gif',
        ], [], [
            'url'               => ' URL',
            'title_en'          => ' Title in English',
            'button_en'         => ' Button in English',
            'image_id'          => ' Image',
        ]);


        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/slider', $fileName);
            $filePath = uploadedImagePath() . '/slider/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
            $slide->image_id = $input['image_id'];
        }

        //Update Slide in Slider Table in Main Database
        $slide->url = $input['url'];
        $slide->created_by = $input['created_by'];
        $slide->save();

        $slide->slider_en()->update(['slide_id' => $slide->id, 'title' => $input['title_en'],  'sub_title' => $input['sub_title'], 'description' => $input['description_en'], 'button' => $input['button_en']]);

        Session::flash('create', 'Slide  Has Been Updated Successfully');
        return redirect(adminUrl('slider'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slider::find($id);

        $slide->delete();

        try
        {
            if ($slide->image_id)
            {
                unlink(public_path() . '/' . $slide->image->path);
                DB::table('image')->where('id', $slide->image_id)->delete();
            }
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Slide Because The Slide is related to another table');
            return redirect()->back();
        }

        Session::flash('delete', 'Slide ' . $slide->id . ' Has Been Deleted Successfully');
        return redirect(adminUrl('slider'));
    }
}
