<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Teachers\{StoreTeacherRequest , UpdateTeacherRequest };
use App\Actions\Board\Teachers\{StoreTeacherAction  , UpdateTeacherAction };

use App\Models\Teacher;
use App\Models\User;
use Spatie\Permission\Models\Permission;
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
        $permissions = Permission::get()->groupBy('group_name');
        return view('board.teachers.create' , compact('permissions') );
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
        $permissions = Permission::get()->groupBy('group_name');

        $user = User::find($teacher->id);
        $user_permissions = $user->permissions()->pluck('name')->toArray();
        return view('board.teachers.edit' , compact('teacher' , 'permissions'  ,  'user_permissions' ) );
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
