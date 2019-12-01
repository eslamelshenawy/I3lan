<?php
/**
 * Created by PhpStorm.
 * User: Kidwany
 * Date: 1/14/2019
 * Time: 7:52 PM
 */

namespace App\Http\ViewComposers;

use App\Models\Contact;
use App\Models\About;
use App\Models\Setting;
use App\Models\Service;
use  Illuminate\View\View;

class LayoutsComposer
{
    public function compose(View $view)
    {

        // Return Projects In the footer of all pages

        //retrieve Projects in footer
        $contact = Contact::orderby('id', 'desc')->first();
        $about = About::with('about_'.currentLang())->orderBy('created_at', 'desc')->first();
        $setting = Setting::with('setting_'.currentLang(), 'image')->orderBy('created_at', 'desc')->first();
        $services = Service::with('service_en')->where('parent_service_id', null)->get();

        $view->with('contact', $contact)
                ->with('about', $about)
                ->with('setting', $setting)
                ->with('services', $services);
    }
}
