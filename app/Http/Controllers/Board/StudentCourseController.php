<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{CourseStudent , Group , Student , Course };
use App\Http\Requests\Board\Students\Courses\UpdateStudentCourseRequest;
class StudentCourseController extends Controller
{


    public function index(Student $student)
    {
        return view('board.students.courses.index' , compact('student') );
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Student $student , Course $course)
    {
        $student_course = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )->first();
        $student_course->load(['user' , 'student' , 'course', 'group' ]);
        return view('board.students.courses.show' , compact('student_course') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Student $student , Course $course)
    {
        $student_course = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )->first();
        $groups = Group::select('name' , 'id' , 'course_id' )->where('course_id' , $student_course->course_id )->get();

        return view('board.students.courses.edit' , compact('student_course' , 'groups' ) );
    }

    public function update( UpdateStudentCourseRequest $request ,  Student $student , Course $course)
    {
        $student_course = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )->first();
        $student_course->group_id = $request->group_id;
        $student_course->allow = $request->filled('allow')  ? 1 : 0;
        $student_course->force_headphones = $request->filled('force_headphones')  ? 1 : 0;
        $student_course->allow = $request->filled('allow')  ? 1 : 0;
        $student_course->in_office = $request->filled('in_office')  ? 1 : 0;
        $student_course->show_phone_on_viedo = $request->filled('show_phone_on_viedo')  ? 1 : 0;
        $student_course->speak_user_phone = $request->filled('speak_user_phone')  ? 1 : 0;
        $student_course->force_face_detecting = $request->filled('force_face_detecting')  ? 1 : 0;
        $student_course->office_library = $request->filled('office_library')  ? 1 : 0;
        $student_course->online_library = $request->filled('online_library')  ? 1 : 0;
        $student_course->save();

        return redirect()->back()->with('success' , trans('courses.updated successfully' ) );
    }


    public function create()  {
        
        return view('board.students.courses.create');
    }

    public function allow_units()  {
        
        return view('board.students.courses.allow_units');
    }


    public function allow_lessons()  {
        
        return view('board.students.courses.allow_lessons');
    }

    public function remove()  {
        
        return view('board.students.courses.remove');
    }

}
