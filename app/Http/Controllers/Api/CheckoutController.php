<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CheckoutRequest;
use App\Models\Leftover;
use Auth;
use App\Models\Cart;
use App\Models\LeftoverItem;
use App\Jobs\MoveCartFilesToLeftoverFolderOnS3Job;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CheckoutRequest $request)
    {
        $total_points = 0 ; 
        $cart_items = Cart::with('item')->where('user_id' , Auth::id() )->get();

        if (count($cart_items) == 0 ) {
            return response()->json([
                'status' => false , 
                'message' => trans('api.empty_cart') , 
                'data' => (object)[] , 
                'errors' => []
            ], 200);
        }

        foreach ($cart_items as $cart_item) {
            $total_points += $cart_item->item?->points;
        }
        $Leftover = new Leftover;
        $Leftover->number = time().mt_rand(0 , 300).Auth::id();
        $Leftover->where_to_deliver = $request->where_to_deliver;
        $Leftover->user_id = Auth::id();
        $Leftover->total_points  = $total_points;
        $Leftover->status = Leftover::PENDDING;
        $Leftover->user_address_id = $request->user_address_id;
        $Leftover->save();

        $LeftoverItems = [];


        foreach ($cart_items as $cart_item) {
            $LeftoverItems[] = new LeftoverItem([
                'item_id' => $cart_item->item_id ,
                'brand_id' => $cart_item->brand_id , 
                'images' => $cart_item->images , 
                'description' => $cart_item->description , 
                'voice_note' => $cart_item->voice_note , 
                'item_status' => 1 , 
                'item_status_id' => $cart_item->status_id , 
            ]);
        }
        $Leftover->items()->saveMany($LeftoverItems);

        Cart::with('item')->where('user_id' , Auth::id() )->delete();
        return response()->json([
            'status' => true , 
            'message' => trans('api.leftover_added_success') , 
            'data' => (object)[] , 
            'errors' => []
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
