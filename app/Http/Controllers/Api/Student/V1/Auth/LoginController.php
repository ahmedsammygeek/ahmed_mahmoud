<?php

namespace App\Http\Controllers\Api\Student\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Student\V1\Auth\LoginRequest;
use Auth;
use Hash;
use App\Models\Student;
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\V1\Auth\StudentResource;
use Log;
class LoginController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(LoginRequest $request)
    {

        Log::info($request->all());

        $student = Student::where('mobile', $request['mobile'])->first();
        if(!$student || !Hash::check($request['password'],$student->password)){
            
            return $this->response(
                status : 'error' ,
                statusCode : 401 , 
                message  : trans('api.mobile ,  password is wrong ')
            );

        }


        $student->firebase_fcm = $request->firebase_fcm;
        $student->save();


        $data = [
            'user' => new StudentResource($student) , 
            'token' => $student->createToken($student->id)->plainTextToken
        ];

        return $this->response(
            data : $data  ,
            statusCode : 200 ,
            message : trans('api.logined in successfully')
        );
    }


}
