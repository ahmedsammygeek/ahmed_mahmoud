<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Grade  , EducationalSystem,  Teacher, Course  , CourseEducationalSystem };
use App\Http\Requests\Board\Courses\{ StoreCourseRequest , UpdateCourseRequest};
use App\Actions\Board\Courses\{ StoreCourseAction , UpdateCourseAction };
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::select('id' , 'name' )->get();
        $systems = EducationalSystem::select('id' , 'name' )->get();
        $teachers = Teacher::select('id' , 'name' )->get();
        return view('board.courses.create' , compact('systems' , 'grades' , 'teachers' ) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request , StoreCourseAction $action  )
    {
        $action->execute($request);

        return redirect(route('board.courses.index'))->with('success' , trans('courses.course addedd successfully') );
    }

    /**
     * Display the specified resource.
    */
    public function show(Course $course)
    {
        $course->load('grade' , 'user' , 'teachers.teacher'  , 'educationalSystems.educationalSystem' );
        return view('board.courses.show' , compact('course' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $grades = Grade::select('id' , 'name' )->get();
        $systems = EducationalSystem::select('id' , 'name' )->get();
        $teachers = Teacher::select('id' , 'name' )->get();
        $course_educational_systems = CourseEducationalSystem::where('course_id' , $course->id )->pluck('educational_system_id')->toArray();
        return view('board.courses.edit' , compact( 'course' ,  'systems' , 'grades' , 'teachers'  , 'course_educational_systems' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course ,UpdateCourseAction $action )
    {
        $action->execute($request  , $course );
        return redirect(route('board.courses.index'))->with('success' , trans('dashboard.updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
