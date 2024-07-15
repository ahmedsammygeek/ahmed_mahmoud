<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\EducationalSystems\{StoreEducationalSystemRequest , UpdateEducationalSystemRequest } ; 
use App\Actions\Board\EducationalSystems\{StoreEducationalSystemAction , UpdateEducationalSystemAction };
use App\Models\EducationalSystem;
class EducationalSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.educational_systems.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.educational_systems.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEducationalSystemRequest $request , StoreEducationalSystemAction $action )
    {
        $action->execute($request->all());

        return redirect(route('board.educational_systems.index'))->with('success' , trans('dashboard.added successfully') );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationalSystem $educational_system)
    {
        return view('board.educational_systems.edit' , compact('educational_system') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEducationalSystemRequest $request, EducationalSystem $educational_system , UpdateEducationalSystemAction $action )
    {  
        $action->execute( $educational_system ,  $request->all());
        return redirect(route('board.educational_systems.index'))->with('success' , trans('dashboard.updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
