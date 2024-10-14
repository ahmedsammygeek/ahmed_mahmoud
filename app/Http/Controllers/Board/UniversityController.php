<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Universities\{StoreNewUniversity, UpdateNewUniversity};
use App\Models\University;
use Auth;
class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.universities.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.universities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewUniversity $request)
    {
        $university = new University;
        $university->setTranslation('name'  ,'ar' , $request->name_ar );
        $university->setTranslation('name'  ,'en' , $request->name_en );
        $university->user_id = Auth::id();
        $university->is_active = 1;
        $university->save();

        return redirect(route('board.universities.index'))->with('university.added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        return view('board.universities.show' , compact('university'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
    return view('board.universities.edit' , compact('university') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewUniversity $request, University $university)
    {
        $university->setTranslation('name'  ,'ar' , $request->name_ar );
        $university->setTranslation('name'  ,'en' , $request->name_en );
        $university->is_active = $request->filled('active')  ? 1: 0 ;
        $university->save();

        return redirect(route('board.universities.index'))->with('university.updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
