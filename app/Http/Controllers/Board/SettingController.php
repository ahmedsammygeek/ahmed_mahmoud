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
        $settings->save();

        return redirect()->back()->with('success' , trans('dashboard.updated successfully'));


    }
}
