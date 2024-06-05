<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;
use App\Http\Resources\Api\User\UserResource;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => true, 
            'message' => '' , 
            'errors' => [] , 
            'data' => (object)[
                'user' => new UserResource(Auth::user())
            ]
        ]);
    }


    public function update(Request $request)
    {
        $validateData = Validator::make($request->all(), 
            [
                'name' => 'required',
                'image' => 'nullable|image',
                'email' => 'required|email|unique:users,email,'.Auth::id(),
                'phone' => 'required|unique:users,phone,'.Auth::id() , 
            ]);

        if($validateData->fails()){
            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => [$validateData->errors()->first()] ,
                'data' => (object)[] , 
            ], 403);
        }   


        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->hasFile('image')) {
            $user->image = basename($request->file('image')->store('users'));
        }
        $user->save();

        return response()->json([
            'status' => true,
            'message' => trans('api.profile_updated'),
            'errors' => [] ,
            'data' => (object)[] , 
        ], 200);
    }



    public function change_password(Request $request)
    {
        $validateData = Validator::make($request->all(), 
            [
                'current_password' => 'required',
                'password' => 'required|confirmed',
            ]);

        if($validateData->fails()){
            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => [$validateData->errors()->first()] ,
                'data' => (object)[] , 
            ], 403);
        }   


        if (!Hash::check($request->current_password, Auth::user()->password )) {
            return response()->json([
                'status' => false,
                'message' => trans('api.current_password_is_wrong'),
                'errors' => [] ,
                'data' => (object)[] , 
            ], 403);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();


        return response()->json([
            'status' => true,
            'message' => trans('api.password_changed'),
            'errors' => [] ,
            'data' => (object)[] , 
        ], 200);
    }


    public function points()
    {
        $user = Auth::user();
        return response()->json([
            'status' => true,
            'message' => trans('api.password_changed'),
            'errors' => [] ,
            'data' => (object)[
                'points' => $user->points , 
                'money' => $user->money()  , 
            ] , 
        ], 200);
    }
}
