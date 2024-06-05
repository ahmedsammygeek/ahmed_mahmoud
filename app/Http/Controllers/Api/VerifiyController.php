<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carbon\Carbon;
use App\Models\PhoneVerificationCode;
class VerifiyController extends Controller
{





    public function verifiy(Request $request)
    {
        $validateUser = Validator::make($request->all(), 
            [
                'code' => 'required',
            ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => [$validateUser->errors()->first()] ,
                'data' => (object)[] , 
            ], 403);
        } 


        $check = PhoneVerificationCode::where('code' , $request->code )->where('phone' , Auth::user()->phone )->first();


        if (!$check) {
            return response()->json([
                'status' => false,
                'message' => trans('api.code_not_valid'),
                'errors' => [] ,
                'data' => (object)[] , 
            ], 402);
        }

        $check->delete();

        $user = Auth::user();
        $user->phone_verified_at = Carbon::now();
        $user->save();


        return response()->json([
            'status' => true,
            'message' => trans('api.account_verified'),
            'errors' => [] ,
            'data' => (object)[] , 
        ], 200);
    }
}
