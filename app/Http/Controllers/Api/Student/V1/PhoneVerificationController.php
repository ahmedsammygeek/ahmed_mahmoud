<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Http\Requests\Api\Student\V1\Verification\VerifyCodeRequest;
use App\Models\PhoneVerificationCode;
use Auth;
use Carbon\Carbon;
class PhoneVerificationController extends Controller
{

    use GeneralResponse;

    public function index(VerifyCodeRequest $request)
    {
        $student = Auth::guard('student')->user();
        // we need to check if this code in  PhoneVerificationCode model or not

        $check_code_status = PhoneVerificationCode::where([
            [ 'code' , '=' ,  $request->code  ] , 
            [ 'mobile' , '=' ,  $student->mobile  ]
        ])->first();


        if (!$check_code_status) {

            return $this->response(
                status : 'error' ,
                message : trans('api.code is not correct') , 
                statusCode : 200 ,
            );
        }

        $check_code_status->delete();
        $student->phone_verified_at = Carbon::now();
        $student->save();


        return $this->response(
            message : trans('api.phone verified successfully') , 
            statusCode : 200 ,
        );    
    }

    public function send_code()
    {
        $student = Auth::guard('student')->user();

        $check_code_status = PhoneVerificationCode::where('mobile' , $student->mobile)->first();


        // we need first to check if there is code to this student or not to limit sending sms

        if ($check_code_status) {

            // we need to get the difrenc in seconds between now and the time which code was send
            $differnce_in_seconds = $check_code_status->created_at->diffInMinutes(Carbon::now());
            if ($differnce_in_seconds < 3 ) {
                return $this->response(
                    message : trans('api.you need to wait 3 minutes at least') , 
                    statusCode : 200 ,
                    status : 'error'
                );   
            }

            $check_code_status->delete();
        }




        $code = new PhoneVerificationCode;
        $code->code = '123456';
        $code->mobile = $student->mobile;
        $code->save();


        return $this->response(
            message : trans('api.code resend again successfully') , 
            statusCode : 200 ,
        );    
    }



}
