<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Grades\{StoreGradeRequest , UpdateGradeRequest };
use App\Actions\Board\Grades\{StoreGradeAction , UpdateGradeAction };
use App\Models\Grade;
class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.grades.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request  , StoreGradeAction $action )
    {
        $action->execute($request->all());

        return redirect(route('board.grades.index'))->with('success' , trans('dashboard.added successfully') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        return view('board.grades.edit' , compact('grade') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, Grade $grade , UpdateGradeAction $action )
    {
        $action->execute( $grade ,  $request->all());

        return redirect(route('board.grades.index'))->with('success' , trans('dashboard.updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
