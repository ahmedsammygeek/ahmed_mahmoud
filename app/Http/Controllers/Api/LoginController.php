<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;
use App\Http\Resources\Api\User\UserResource;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validateUser = Validator::make($request->all(), 
            [
                'password' => 'required',
                'phone' => 'required' , 
            ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => [$validateUser->errors()->first()] ,
                'data' => (object)[] , 
            ], 403);
        }   


        // dd($validateUser->password);

        if (!Auth::attempt(['password' => $request->password , 'phone' => $request->phone ])) {
            return response()->json([
                'status' => false,
                'message' => trans('api.login_faild') ,
                'errors' => [] ,
                'data' => (object)[] , 
            ], 403);
        }



        return response()->json([
                'status' => true,
                'message' => trans('api.logged') ,
                'errors' => [] ,
                'data' => (object)[
                     'user' => new UserResource(Auth::user()) ,
                'token' => Auth::user()->createToken("API TOKEN")->plainTextToken  , 
                ] , 
            ], 200);

    }

}
