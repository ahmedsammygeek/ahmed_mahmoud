<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leftover;
use App\Models\ItemStatus;
use App\Models\Slide;
use App\Models\Bank;
use App\Models\About;
use App\Models\Privacy;
use Auth;
use App\Http\Resources\AboutResource;
use App\Http\Resources\PrivacyResource;
use App\Http\Resources\Api\Leftovers\LeftoverResource;
use App\Http\Resources\Api\ItemStatusesResource;
use App\Http\Resources\Api\Slides\SlideResource;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lastLeftovers = Leftover::where('user_id' , Auth::id() )->when($request->status , function($query) use($request) {
            $query->where('status' , $request->status );
        })->latest()->take(1)->get();


        $Leftovers = Leftover::where('user_id' , Auth::id() )->when($request->status , function($query) use($request) {
            $query->where('status' , $request->status );
        })->whereNotIn('id' , $lastLeftovers->pluck('id')->toArray() )->latest()->get();


        $slides = Slide::where('is_active' , 1 )->orderBy('order' , 'DESC' )->get();
        return response()->json([
            'status' => true , 
            'message' => '' , 
            'data' => (object) [
                'slides' => SlideResource::collection($slides) ,
                'leftovers' => LeftoverResource::collection($Leftovers) , 
                'last_leftovers' => LeftoverResource::collection($lastLeftovers) ,
            ] , 
            'errors' => [] , 
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function items_statuses()
    {
        $items_statuses = ItemStatus::select('id' , 'name' )->get();
        return response()->json([
            'status' => true , 
            'message'=> '' , 
            'errors' => [] , 
            'data' => (object) [
                'items_statuses' => ItemStatusesResource::collection($items_statuses) , 
            ]

        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function banks()
    {
        $banks = Bank::select('id' , 'name')->get();
        return response()->json([
            'data' => (object)[
                'banks' => $banks , 
            ], 
            'errors' => [] , 
            'message' => '' , 
            'status' => true , 
        ], 200);
    }

    public function about()
    {
        $about = About::first();

        return response()->json([
            'status' => true , 
            'errors' => [] , 
            'message' => '' , 
            'data' => (object) [
                'about' => new AboutResource($about)
            ]
        ], 200);
    }

    public function privacy()
    {
        $privacy = Privacy::first();

        return response()->json([
            'status' => true , 
            'errors' => [] , 
            'message' => '' , 
            'data' => (object) [
                'privacy' => new PrivacyResource($privacy)
            ]
        ], 200);
    }

}
