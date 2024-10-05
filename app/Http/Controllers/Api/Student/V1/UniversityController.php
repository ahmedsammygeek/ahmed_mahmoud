<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Models\University;
use App\Http\Resources\Api\Student\V1\UniversityResource;
class UniversityController extends Controller
{

    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universities = University::where('is_active' , 1 )->latest()->get();

        $data = [
            'universities' => UniversityResource::collection($universities) , 

        ];
        return $this->response(

            data : $data  

        );
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
