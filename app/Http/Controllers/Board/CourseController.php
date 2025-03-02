<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Grade  , EducationalSystem, Student , Teacher, Course  , CourseEducationalSystem };
use App\Http\Requests\Board\Courses\{ StoreCourseRequest , UpdateCourseRequest};
use App\Actions\Board\Courses\{ StoreCourseAction , UpdateCourseAction };
use Gate;
use Auth;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('list all courses');
        return view('board.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('add new course');
        $grades = Grade::select('id' , 'name' )->get();
        $systems = EducationalSystem::select('id' , 'name' )->get();
        if (Auth::user()->type == 1 ) {
            $teachers = Teacher::select('id' , 'name' )->get();
        } else {
            $teachers = Teacher::select('id' , 'name' )->where('id' , Auth::id() )->get();
        }
        return view('board.courses.create' , compact('systems' , 'grades' , 'teachers' ) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request , StoreCourseAction $action  )
    {
        Gate::authorize('add new course');
        $action->execute($request);
        return redirect(route('board.courses.index'))->with('success' , trans('courses.course addedd successfully') );
    }

    /**
     * Display the specified resource.
    */
    public function show(Course $course)
    {
        Gate::authorize('show course details');
        $course->load('grade' , 'user' , 'teacher'  , 'educationalSystems.educationalSystem' );
        $students_count = $students = Student::with('faculty')
        ->whereHas('courses' , function($query) use($course) {
            $query->where('course_id' , $course->id );
        })->count();
        return view('board.courses.show' , compact('course' , 'students_count' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        Gate::authorize('edit course details');

        $grades = Grade::select('id' , 'name' )->get();
        $systems = EducationalSystem::select('id' , 'name' )->get();
        $course_educational_systems = CourseEducationalSystem::where('course_id' , $course->id )->pluck('educational_system_id')->toArray();

        if (Auth::user()->type == 1 ) {
            $teachers = Teacher::select('id' , 'name' )->get();
        } else {
            $teachers = Teacher::select('id' , 'name' )->where('id' , Auth::id() )->get();
        }

        return view('board.courses.edit' , compact( 'course' ,  'systems' , 'grades' , 'teachers'  , 'course_educational_systems' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course ,UpdateCourseAction $action )
    {
        Gate::authorize('edit course details');
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
