<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Models\Setting;
use App\Http\Resources\Api\Student\Api\Settings\SettingResource;
class SettingController extends Controller
{
     use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Setting = Setting::first();

        $data['settings'] = SettingResource::make($Setting);

        return $this->response(
            data : $data  
        );
    }

  
}