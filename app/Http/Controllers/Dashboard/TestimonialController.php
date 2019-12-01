<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Image;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::with('testimonial_en', 'createdBy')->get();
        return view('dashboard.testimonial.campaign', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.testimonial.create');
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
            'username_en'       => 'bail|required|max:200',
            'username_ar'       => 'bail|required',
            'text_en'           => 'bail|required',
            'text_ar'           => 'bail|required',
            'image_id'          => 'bail|mimes:jpeg,jpg,png,gif',
        ], [], [
            'username_en'       => 'Username in English',
            'username_ar'       => 'Username in Arabic',
            'text_en'           => 'Testimonial Text in English',
            'text_ar'           => 'Testimonial Text in Arabic',
        ]);

        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/testimonial', $fileName);
            $filePath = 'dashboardImages/testimonial/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
        }



        $testimonial = new Testimonial();
        $testimonial->created_by = $input['created_by'];
        $testimonial->image_id = $input['image_id'];
        $testimonial->save();

        $testimonial->testimonial_ar()->create(['testimonial_id' => $testimonial->id, 'username' => $input['username_ar'], 'text' => $input['text_ar']]);
        $testimonial->testimonial_en()->create(['testimonial_id' => $testimonial->id, 'username' => $input['username_en'], 'text' => $input['text_en']]);

        Session::flash('create', 'Testimonial  Has Been Created Successfully');
        return redirect(adminUrl('testimonial'));
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
        $testimonial = Testimonial::with( 'testimonial_en', 'testimonial_ar', 'createdBy')->find($id);
        return view('dashboard.testimonial.edit', compact('testimonial'));
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
        $testimonial = Testimonial::with( 'testimonial_en', 'testimonial_ar', 'createdBy')->find($id);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'username_en'       => 'bail|required|max:200',
            'username_ar'       => 'bail|required',
            'text_en'           => 'bail|required',
            'text_ar'           => 'bail|required',
        ], [], [
            'username_en'       => 'Username in English',
            'username_ar'       => 'Username in Arabic',
            'text_en'           => 'Testimonial Text in English',
            'text_ar'           => 'Testimonial Text in Arabic',
        ]);

        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/testimonial', $fileName);
            $filePath = 'dashboardImages/testimonial/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
            $testimonial->image_id = $input['image_id'];
        }

        $testimonial->created_by = $input['created_by'];

        $testimonial->save();

        $testimonial->testimonial_ar()->update(['testimonial_id' => $testimonial->id, 'username' => $input['username_ar'], 'text' => $input['text_ar']]);
        $testimonial->testimonial_en()->update(['testimonial_id' => $testimonial->id, 'username' => $input['username_en'], 'text' => $input['text_en']]);

        Session::flash('update', 'Testimonial  Has Been Updated Successfully');
        return redirect(adminUrl('testimonial'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);

        $testimonial->delete();

        Session::flash('delete', 'Testimonial Has Been Deleted Successfully');
        return redirect(adminUrl('testimonial'));
    }
}
