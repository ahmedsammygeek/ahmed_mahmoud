<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\V1\Auth\StudentResource;
use Auth;
class ProfileController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $student = Auth::guard('student')->user();
        $data = [
            'user' => new StudentResource($student)
        ];

        return $this->response(
            data : $data  ,
            statusCode : 200 ,
        );
    }

}
