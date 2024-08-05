<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Teachers\{StoreTeacherRequest , UpdateTeacherRequest };
use App\Actions\Board\Teachers\{StoreTeacherAction  , UpdateTeacherAction };

use App\Models\Teacher;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request , StoreTeacherAction $action )
    {
        $action->handle($request->all());
        return redirect(route('board.teachers.index'))->with('success' , trans('board.added successfully') );
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $teacher->load(['courses'  , 'user' ]);
        return view('board.teachers.show' , compact('teacher') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('board.teachers.edit' , compact('teacher') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request,Teacher $teacher , UpdateTeacherAction $action )
    {
        $action->handle( $teacher ,  $request->all());
        return redirect(route('board.teachers.index'))->with('success' , trans('board.added successfully') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
