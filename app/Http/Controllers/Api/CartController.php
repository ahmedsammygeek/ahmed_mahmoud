<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Cart\StoreItemInCartRequest;
use App\Models\Cart;
use Auth;
use App\Http\Requests\Api\Cart\DeleteCartItemRequest;
use App\Http\Resources\Api\Cart\CartItemResource;
use Storage;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Cart::where('user_id' , Auth::id() )->get();


        $total_points = 0;

        foreach ($items as $item) {
            $total_points += $item->item->points;
        }



        return response()->json([
            'message' => '', 
            'status' => true , 
            'errors' => [] , 
            'data' => (object) [
                'items' => CartItemResource::collection($items) , 
                'statistics' => [
                    'items_count' => $items->count() , 
                    'total_points' => $total_points , 
                ], 
            ]
        ] ,200);
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
    public function store(StoreItemInCartRequest $request)
    {
        $cart = new Cart;
        $cart->user_id = Auth::id();
        $cart->item_id = $request->item_id;
        $cart->quantity = $request->quantity;
        $cart->brand_id = $request->brand_id;
        $cart->status_id = $request->status_id;
        $cart->quantity = $request->quantity;
        $cart->description = $request->description;
        $cart->save();

        // upload images 
        $images = [];

        if ($request->hasFile('images')) {
            for ($i=0; $i <count($request->images) ; $i++) { 
                $images[] = basename($request->file('images.'.$i)->store('leftover_items'));
            }
            $cart->images = json_encode($images);
        }

        if ($request->hasFile('voice_note')) {
            $cart->voice_note = basename($request->file('voice_note')->store('leftover_items'));
        }
        $cart->save();

        return response()->json([
            'status' => true , 
            'message' => trans('api.item_added_to_cart') , 
            'errors' => [] , 
            'data' => (object) [] , 
        ], 200);

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
    public function destroy(DeleteCartItemRequest $request )
    {
        $cart = Cart::find($request->item_id);
        if($cart) {
            $images_paths = [];
            foreach (json_decode($cart->images) as $cart_image) {
                $images_paths[] = 'leftover_items/'.$cart_image; 
            }
            Storage::delete($images_paths);
            Storage::delete(['leftover_items/'.$cart->voice_note]);
            $cart->delete();
        }
        return response()->json([
            'status' => true , 
            'message' => trans('api.item_removed_from_cart') , 
            'data' => (object) [] , 
            'errors' => [] , 
        ], 200);
    }
}
