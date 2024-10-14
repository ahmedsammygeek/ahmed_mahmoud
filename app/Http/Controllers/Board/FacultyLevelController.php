<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Faculty , FacultyLevel};
use App\Http\Requests\Board\Faculties\{StoreFacultyLevelRequest , UpdateFacultyLevelRequest};
use Auth;
class FacultyLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.faculty_levels.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::get();
        return view('board.faculty_levels.create' , compact('faculties') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacultyLevelRequest $request)
    {
        $level = new FacultyLevel;
        $level->faculty_id = $request->faculty_id;
        $level->setTranslation('name' , 'ar' , $request->name_ar );
        $level->setTranslation('name' , 'en' , $request->name_en );
        $level->user_id = Auth::id();
        $level->is_active = 1;
        $level->save();

        return redirect(route('board.faculty_levels.index'))->with('success' , 'تم الاضافه بنجاح' );

    }

    /**
     * Display the specified resource.
     */
    public function show(FacultyLevel $faculty_level)
    {
        return view('board.faculty_levels.show' , compact('faculty_level') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacultyLevel $faculty_level)
    {
        $faculties = Faculty::get();
        return view('board.faculty_levels.edit' , compact('faculties'   , 'faculty_level' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacultyLevelRequest $request, FacultyLevel $faculty_level)
    {

        $faculty_level->faculty_id = $request->faculty_id;
        $faculty_level->setTranslation('name' , 'ar' , $request->name_ar );
        $faculty_level->setTranslation('name' , 'en' , $request->name_en );
        $faculty_level->is_active = $request->filled('active') ? 1 : 0 ;
        $faculty_level->save();

        return redirect(route('board.faculty_levels.index'))->with('success' , 'تم التعديل بنجاح' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
