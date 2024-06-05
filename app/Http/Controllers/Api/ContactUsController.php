<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\ContactUs;
class ContactUsController extends Controller
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
                'notes' => 'required',
            ]);

        if($validateData->fails()){
            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => [$validateData->errors()->first()] ,
                'data' => (object)[] , 
            ], 403);
        }   

        $message = new ContactUs;
        $message->name = $request->name;
        $message->phone = $request->phone;
        $message->notes = $request->notes;
        $message->save();

        return response()->json([
            'status' => true,
            'message' => trans('api.request_received'),
            'errors' => [] ,
            'data' => (object)[] , 
        ], 200);

    }

}
