<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\About;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::orderBy('created_at', 'desc')->first();
        return view('dashboard.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::with('about_en', 'about_ar', 'missionImage', 'visionImage', 'valuesImage')->orderBy('created_at', 'desc')->first();
        $input = $request->all();
        $this->validate($request,[
            'mission_en'        => 'bail|required|min:50|max:1500',
            'vision_en'         => 'bail|required|min:50|max:1500',
            'values_en'         => 'bail|required|min:50|max:1500',
            'description_en'    => 'bail|required|min:50|max:1500',
            'mission_image_id'  => 'mimes:jpeg,jpg,png,gif',
            'vision_image_id'   => 'mimes:jpeg,jpg,png,gif',
            'values_image_id'   => 'mimes:jpeg,jpg,png,gif',
            'about_image_id'   => 'mimes:jpeg,jpg,png,gif',
        ], [], [
            'about_en'          => 'About in English',
            'about_ar'          => 'About in Arabic'
        ]);

        //Upload Slide Image
        if ($uploadedFile = $request->file('about_image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/about', $fileName);
            $filePath = uploadedImagePath() . '/about/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['about_image_id'] = $image->id;
            $about->image_id = $input['about_image_id'];
        }

        if ($uploadedFile = $request->file('mission_image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/about', $fileName);
            $filePath = uploadedImagePath() . '/about/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['mission_image_id'] = $image->id;
            $about->mission_image_id = $input['mission_image_id'];
        }

        if ($uploadedFile = $request->file('vision_image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/about', $fileName);
            $filePath = uploadedImagePath() . '/about/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['vision_image_id'] = $image->id;
            $about->vision_image_id = $input['vision_image_id'];
        }

        if ($uploadedFile = $request->file('values_image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/about', $fileName);
            $filePath = 'dashboardImages/about/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['values_image_id'] = $image->id;
            $about->values_image_id = $input['values_image_id'];
        }

        //Save Images
        $about->save();

        $about->about_en()->update(['about_id' => $about->id, 'mission' => $input['mission_en'], 'vision' => $input['vision_en'], 'value' => $input['values_en'], 'description' => $input['description_en']]);

        Session::flash('create', 'About Website Has Been Updated Successfully');
        return redirect(adminUrl('about/edit'));
    }
}
