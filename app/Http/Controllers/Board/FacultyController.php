<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Faculties\{StoreFacultyRequest , UpdateFacultyRequest};
use Auth;
use App\Models\Faculty;
class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view('board.faculties.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacultyRequest $request)
    {
        $Faculty = new Faculty;
        $Faculty->setTranslation('name' , 'ar' , $request->name_ar );
        $Faculty->setTranslation('name' , 'en' , $request->name_en );
        $Faculty->user_id = Auth::id();
        $Faculty->is_active = 1;
        $Faculty->save();

        return redirect(route('board.faculties.index'))->with('success' , 'تم الاضافه بنجاح' );
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
    public function edit(Faculty $faculty)
    {
        return view('board.faculties.edit' , compact('faculty') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacultyRequest $request,Faculty $faculty)
    {
        $faculty->setTranslation('name' , 'ar' , $request->name_ar );
        $faculty->setTranslation('name' , 'en' , $request->name_en );
        $faculty->is_active = $request->filled('active')  ? 1 : 0 ;
        $faculty->save();

        return redirect(route('board.faculties.index'))->with('success' , 'تم التعديل بنجاح' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
