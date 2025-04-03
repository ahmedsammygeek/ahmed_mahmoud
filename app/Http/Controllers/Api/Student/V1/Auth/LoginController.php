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

        if ($student->is_banned == 1 ) {

            $message = 'تم عمل بلوك للحساب الخاص بك';

            if ($student->banning_message) {
                $message = $message .' , '. $student->banning_message;
            }


            return $this->response(
                statusCode : 403 ,
                message : $message
            );
        }



        // Auth::guard('student')->logout();

        // dd($student->tokens()->first());

        if ($student->tokens()->first()) {
            return $this->response(
                statusCode : 403 ,
                message : trans('api.you have an active session indeed')
            );
        }

        if ($student->unique_device_id == null && $student->mobile_serial_number == null ) {
            return $this->generateToken($student , $request);
        }


        if (($request->device_serial_number == $student->mobile_serial_number) || ($request->unique_device_id == $student->unique_device_id) ) {   
            return $this->generateToken($student , $request);
        }

        
        

        return $this->response(
            statusCode : 403 ,
            message : trans('api.you have an active session indeed')
        );
        
    }

    public function generateToken($student , $request)
    {

        $student->firebase_fcm = $request->firebase_fcm;
        $student->unique_device_id = $request->unique_device_id;
        $student->mobile_serial_number = $request->mobile_serial_number;
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
