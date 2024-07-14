<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Exams\StoreExamRequest;

use App\Actions\Board\Exams\StoreExamAction;


use App\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.exams.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , StoreExamAction $action )
    {
        $action->execute($request->all());
        return redirect(route('board.exams.index'))->with('success' , trans('exams.exam added successfully ') );
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $exam->load('questions' , 'user' , 'course' );
        return view('board.exams.show' , compact('exam') );
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
