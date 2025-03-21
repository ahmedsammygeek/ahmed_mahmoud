<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Course , Student , Unit};
use App\Http\Requests\Board\Courses\Units\{StoreCourseUnitRequest , UpdateCourseUnitRequest};
use App\Actions\Board\Courses\Units\{StoreUnitAction , UpdateUnitAction};
class CourseUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $course_students = Student::with('faculty')
        ->whereHas('courses' , function($query) use($course) {
            $query->where('course_id' , $course->id );
        })->count();
        return view('board.units.index' , compact('course' , 'course_students') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('board.units.create', compact('course') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseUnitRequest $request ,Course $course , StoreUnitAction $action )
    {
        $action->execute($request , $course );
        return redirect(route('board.courses.units.index' , $course ))->with('success' , trans('courses.unit added successfully') );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course , Unit $unit )
    {
        return view('board.units.show' , compact('unit' , 'course' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course , Unit $unit )
    {
        return view('board.units.edit' , compact('unit' , 'course' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseUnitRequest $request, Course $course , Unit $unit , UpdateUnitAction $action )
    {
        $action->execute($request , $course , $unit );
        return redirect(route('board.courses.units.index' , $course ))->with('success' , trans('courses.updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
