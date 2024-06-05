<?php

namespace App\Http\Controllers\Api\Student\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use Auth;
class LogoutController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        auth()->guard('student')->user()->tokens()->delete();


        return $this->response(
            statusCode : 200 , 
            message : trans('api.logged out successfully') , 
        );
    }

}
