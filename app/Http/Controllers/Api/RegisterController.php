<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;
use App\Models\User;
use App\Models\PhoneVerificationCode;
use  App\Http\Resources\Api\User\UserResource;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validateUser = Validator::make($request->all(), 
            [
                'password' => 'required',
                'name' => 'required',
                'phone' => 'required|unique:users,phone|size:11' , 
                'email' => 'nullable|unique:users,email|email' , 
                'platform' => 'required' , 
                'firebase_token' => 'required' , 
                'account_type' => 'required' , 
            ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => [$validateUser->errors()->first()] ,
                'data' => (object)[] , 
            ], 403);
        }

        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->platform = $request->platform;
        $user->firebase_token = $request->firebase_token;
        $user->type = User::USER;
        $user->account_type = $request->account_type;
        if ($request->hasFile('image')) {
             $user->image = basename($request->file('image')->store('users'));
        }
        $user->save();

        $code = new PhoneVerificationCode;
        $code->code = '1234';
        $code->phone = $request->phone;
        $code->save();
        Auth::login($user);


        return response()->json([
            'status' => true,
            'message' => trans('api.registerd'),
            'errors' => [] ,
            'data' => (object)[
                'user' => new UserResource(Auth::user()) ,
                'token' => Auth::user()->createToken("API TOKEN")->plainTextToken  , 
            ] , 
        ], 201);
    }

    
}
