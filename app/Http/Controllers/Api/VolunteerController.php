<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Volunteer;
class VolunteerController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), 
            [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'nullable|email',
                'address' => 'required',
            ]);

        if($validateData->fails()){
            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => [$validateData->errors()->first()] ,
                'data' => (object)[] , 
            ], 403);
        }   

        $Volunteer = new Volunteer;
        $Volunteer->name = $request->name;
        $Volunteer->phone = $request->phone;
        $Volunteer->email = $request->email;
        $Volunteer->address = $request->address;
        $Volunteer->save();

        return response()->json([
                'status' => true,
                'message' => trans('api.request_received'),
                'errors' => [] ,
                'data' => (object)[] , 
            ], 200);
    }
   
}
