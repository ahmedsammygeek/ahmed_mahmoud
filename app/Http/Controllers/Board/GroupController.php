<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{CourseTeacherGroup , GroupTime};
use App\Http\Requests\Board\Groups\{StoreGroupRequest , UpdateGroupRequest};
use App\Actions\Board\Groups\{StoreGroupAction , UpdateGroupAction };
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.groups.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request , StoreGroupAction $action )
    {

        $action->execute($request->validated());


        return to_route('board.groups.index')->with('success' , trans('group.added successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseTeacherGroup $group)
    {

        $times = GroupTime::select('id' , 'time_from' , 'time_to'  )->where('course_teacher_group_id' , $group->id )->get();

        $times = $times->map(function($time) {
            return [
                'day' => $time->time_from->dayName ,
                'start' => $time->time_from,
                'end' => $time->time_to,
            ];
        })->unique('day');
        // dd($times);
        $group->load('times' , 'CourseTeacher' , 'user' );
        return view('board.groups.show' , compact('group' , 'times' ) );
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
    public function calendar(CourseTeacherGroup $group)
    {

        $times = GroupTime::select('id' , 'time_from' , 'time_to'  )->where('course_teacher_group_id' , $group->id )->get();

        $times = $times->map(function($time) use($group) {
            return [
                'title' =>$group->name,
                'start' => $time->time_from,
                'end' => $time->time_to,
            ];
        })->toArray();

        return view('board.groups.calendar' , compact('group' , 'times' ) );
    }
}
