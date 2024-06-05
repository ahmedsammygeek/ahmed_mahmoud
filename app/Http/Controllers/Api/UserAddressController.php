<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\User\Addresses\StoreUserAddressRequest;
use App\Http\Requests\Api\User\Addresses\UpdateUserAddressRequest;
use Auth;
use App\Models\UserAddress;
use App\Http\Resources\Api\User\Addresses\AddressReource;
class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = UserAddress::with(['governorate' , 'city' ])->where('user_id' , Auth::id() )->latest()->get();
        return response()->json([
            'status' => true , 
            'message' => '' , 
            'data' => (object) [

                'addresses' => AddressReource::collection($addresses)
            ] , 
            'errors' => [] , 
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAddressRequest $request)
    {
        $address = new UserAddress;
        $address->user_id = Auth::id();
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->address = $request->address;
        $address->governorate_id = $request->governorate_id;
        $address->city_id = $request->city_id;
        $address->save();

        return response()->json([
            'status' => true , 
            'message' => trans('api.address_added') , 
            'data' => (object)[] , 
            'errors' => [] 
        ], 
        200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $address)
    {
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->address = $request->address;
        $address->governorate_id = $request->governorate_id;
        $address->city_id = $request->city_id;
        $address->save();

        return response()->json([
            'status' => true , 
            'message' => trans('api.address_updated') , 
            'data' => (object)[] , 
            'errors' => [] 
        ], 
        200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $address)
    {
        $address->delete();
        return response()->json([
            'status' => true , 
            'data' => (object)[] , 
            'message' => trans('api.address_deleted') , 
            'errors' => [] , 
        ], 200);
    }
}
