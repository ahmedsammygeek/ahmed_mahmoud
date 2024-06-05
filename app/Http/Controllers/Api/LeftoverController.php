<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leftover;
use App\Http\Resources\Api\Leftovers\LeftoverFullDetailsResource;
class LeftoverController extends Controller
{
   

    /**
     * Display the specified resource.
     */
    public function show(Leftover $leftover)
    {
        return response()->json([
            'status' => true , 
            'message' => '' , 
            'errors' => [] , 
            'data' => (object) [
                'leftover' => new LeftoverFullDetailsResource($leftover) , 
            ]

        ], 200);
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
