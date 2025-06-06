<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Grade , EducationalSystem , Student };
use App\Http\Requests\Board\Students\{StoreStudentRequest , UpdateStudentRequest};
use Gate;
use App\Actions\Board\StudentActions\{StoreStudentAction , UpdateStudentAction} ;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('list all students');
        return view('board.students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('add new student');
        return view('board.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request  , StoreStudentAction $action)
    {

        Gate::authorize('add new student');
        $student = $action->execute($request->validated());

        return redirect(route('board.students.show' , $student ))->with('success' , trans('students.student addedd successfully') );
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        Gate::authorize('show student details');
        $student->load(['educationalSystem' , 'grade' , 'user' , 'loginDevices' ]);
        return view('board.students.show' , compact('student') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        Gate::authorize('edit student details');
        $grades = Grade::select('id' , 'name' )->get();
        $systems = EducationalSystem::select('id' , 'name')->get();

        return view('board.students.edit' , compact('student' , 'grades' , 'systems' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student , UpdateStudentAction $action )
    {
        Gate::authorize('edit student details');
        $student = $action->execute($request->validated() , $student );

        return redirect(route('board.students.show' , $student ))->with('success' , trans('students.student updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
