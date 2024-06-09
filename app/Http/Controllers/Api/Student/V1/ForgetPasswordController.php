<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Student\V1\ForgetPassword\ForgetPasswordRequest;
use App\Http\Requests\Api\Student\V1\ForgetPassword\VerifyMobileRequest;
use App\Models\Student;
use App\Models\PhoneVerificationCode;
use App\Traits\Api\GeneralResponse;
use App\Http\Requests\Api\Student\V1\ForgetPassword\StorePasswordRequest;
class ForgetPasswordController extends Controller
{
    use GeneralResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(ForgetPasswordRequest $request)
    {
        // we need to check if the student in our database or not
        $student = Student::where('mobile' , $request->mobile )->first();

        if (!$student) {
            return $this->response(
                statusCode : 404 , 
                status : 'error' , 
                message: trans('api.there is no student with this phon number ') , 
            );
        }


        $code = new PhoneVerificationCode;
        $code->code = '123456';
        $code->mobile = $student->mobile;
        $code->save();

        return $this->response(
            statusCode : 200 , 
            message: trans('api.code sent to your phone') , 
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function verify(VerifyMobileRequest $request)
    {
        $student = Student::where('mobile' , $request->mobile )->first();

        if (!$student) {
            return $this->response(
                statusCode : 404 , 
                status : 'error' , 
                message: trans('api.mobile is wrong') , 
            );
        }


        $phone_verification_code = PhoneVerificationCode::where([

            ['mobile' , '=' ,  $request->mobile ] , 
            ['code' , '=' ,  $request->code ] , 
        ])->first();

        if (!$phone_verification_code) {
            return $this->response(
                statusCode : 404 , 
                status : 'error' , 
                message: trans('api.code and mobile is wrong') , 
            );
        }


        return $this->response(
            statusCode : 200 , 
            message: trans('api.you can know change your password') , 
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function change_password(StorePasswordRequest $request)
    {
        $student = Student::where('mobile' , $request->mobile )->first();

        if (!$student) {
            return $this->response(
                statusCode : 404 , 
                status : 'error' , 
                message: trans('api.mobile is wrong') , 
            );
        }


        $phone_verification_code = PhoneVerificationCode::where([

            ['mobile' , '=' ,  $request->mobile ] , 
            ['code' , '=' ,  $request->code ] , 
        ])->first();

        if (!$phone_verification_code) {
            return $this->response(
                statusCode : 404 , 
                status : 'error' , 
                message: trans('api.code and mobile is wrong') , 
            );
        }


        $student->password = $request->password;
        $student->save();

        $phone_verification_code->delete();

        return $this->response(
            statusCode : 200 , 
            message: trans('api.password changed successfully') , 
        );
    }

   
}
