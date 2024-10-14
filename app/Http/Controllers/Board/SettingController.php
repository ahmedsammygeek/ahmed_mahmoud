<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    


    public function edit()
    {
        $settings = Setting::first();
        return view('board.settings.edit' , compact('settings') );
    }


    public function update(Request $request) {

        $settings = Setting::first();
        $settings->allow_virtual_apps = $request->filled('allow_virtual_apps') ? 1 : 0;
        $settings->force_phone_verification = $request->filled('force_phone_verification') ? 1 : 0;
        $settings->allow_developer_mode = $request->filled('allow_developer_mode') ? 1 : 0;
        $settings->application_form_status = $request->filled('application_form_status') ? 1 : 0;
        $settings->default_views_number = $request->default_views_number;
        $settings->default_seen_mints = $request->default_seen_mints;

        if ($request->hasFile('logo')) {
            $settings->logo = basename($request->file('logo')->store('settings'));
        }


        $settings->save();

        return redirect()->back()->with('success' , trans('dashboard.updated successfully'));


    }
}
