<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $info = Setting::orderBy('id', 'desc')->first();
        return view('dashboard.setting.edit', compact('info'));
    }






    public function update(Request $request)
    {
        $setting = Setting::with('setting_en', 'setting_ar', 'image')->orderBy('created_at', 'desc')->first();
        $input = $request->all();
        $this->validate($request,[
            'website_name_en'           => 'bail|max:100',
            'website_name_ar'           => 'bail|required|max:100',
            'website_description_en'    => 'bail|required|max:1000',
            'website_description_ar'    => 'bail|required|max:1000',
            'default_lang'              => 'bail|required',
            'open'                      => 'bail|int',
            'logo'                      => 'bail|file|mimes:jpeg,jpg,png,gif',
        ], [], [
            'website_title_en'          => 'Website Name in English',
            'website_title_ar'          => 'Website Name in Arabic',
            'website_desc_en'           => 'Website Description in English',
            'website_desc_ar'           => 'Website Description in Arabic',
            'default_lang'              => 'Default Language',
            'open'                      => 'Website Status',
            'logo'                      => 'Logo',

        ]);


        if ($uploadedFile = $request->file('logo'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/setting', $fileName);
            $filePath = uploadedImagePath() . '/setting/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['logo'] = $image->id;
            $setting->logo = $input['logo'];
        }



        if (!empty($setting))
        {
            $setting->update($input);

            $setting->setting_ar()->update(['setting_id' => $setting->id, 'website_name' => $input['website_name_ar'], 'website_description' => $input['website_description_ar']]);
            $setting->setting_en()->update(['setting_id' => $setting->id, 'website_name' => $input['website_name_en'], 'website_description' => $input['website_description_en']]);

        }
        else
        {
            Setting::create($input);
            $setting->setting_ar()->create(['setting_id' => $setting->id, 'website_name' => $input['website_name_ar'], 'website_description' => $input['website_description_ar']]);
            $setting->setting_en()->create(['setting_id' => $setting->id, 'website_name' => $input['website_name_en'], 'website_description' => $input['website_description_en']]);


        }

        Session::flash('update', 'Setting Has Been Updated Successfully');

        return redirect(adminUrl('setting/edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
