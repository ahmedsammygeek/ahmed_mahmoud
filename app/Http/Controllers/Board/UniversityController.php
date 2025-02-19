<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Universities\{StoreNewUniversity, UpdateNewUniversity};
use App\Models\University;
use App\Models\Faculty;
use App\Models\UniversityFaculty;
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
        $faculties = Faculty::get();
        return view('board.universities.create' , compact('faculties'));
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

        if ($request->filled('faculties')) {
            $university_faculties = [];
            foreach ($request->faculties as $faculty) {
                $university_faculties[] = new UniversityFaculty([
                    'university_id' => $university->id , 
                    'faculty_id' => $faculty , 
                    'user_id' => Auth::id() , 
                    'is_active' => 1 , 
                ]);
            }
            $university->faculties()->saveMany($university_faculties);
        }

        
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
        $faculties = Faculty::get();
        $university_faculties = UniversityFaculty::where('university_id' , $university->id )->pluck('faculty_id')->toArray();
        return view('board.universities.edit' , compact('university' , 'university_faculties' , 'faculties') );
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

        if ($request->filled('faculties')) {
            $university->faculties()->delete();
            $university_faculties = [];
            foreach ($request->faculties as $faculty) {
                $university_faculties[] = new UniversityFaculty([
                    'university_id' => $university->id , 
                    'faculty_id' => $faculty , 
                    'user_id' => Auth::id() , 
                    'is_active' => 1 , 
                ]);
            }

            $university->faculties()->saveMany($university_faculties);
        }

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
