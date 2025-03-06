<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{CourseStudent , Group , Student , Course , StudentUnit , StudentLesson , LessonVideo};
use App\Http\Requests\Board\Students\Courses\UpdateStudentCourseRequest;
use Auth;
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
        $student_course_units = StudentUnit::where('student_id' , $student->id )
        ->whereHas('unit' , function($query) use($course) {
            $query->where('course_id' , $course->id );
        })
        ->pluck('unit_id')
        ->toArray();


        return view('board.students.courses.edit' , compact('student_course' , 'groups' , 'student_course_units' ) );
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

        $student_course_units = StudentUnit::where('student_id' , $student->id )
        ->whereHas('unit' , function($query) use($course) {
            $query->where('course_id' , $course->id );
        })
        ->pluck('unit_id')
        ->toArray();

        // we need first to add new units add to this student

        foreach ($request->units_id as $unit_id) {

            $student_course_unit = StudentUnit::withTrashed()->where('student_id'  , $student->id )
            ->where('unit_id', $unit_id )->first();

            if ($student_course_unit) {
                if ($student_course_unit->trashed()) {
                    $student_course_unit->restore();
                }
            } else {
                $student_unit = new StudentUnit;
                $student_unit->unit_id = $unit_id;
                $student_unit->student_id = $student->id;
                $student_unit->user_id = Auth::id();
                $student_unit->save();
                $videos = LessonVideo::whereHas('lesson' , function($query) use($unit_id) {
                    $query->where('unit_id'  , $unit_id );
                })->get();
                // now we need to add lessons and videos to this student
                foreach ($videos as $video) {
                    $student_lesson_video = new StudentLesson;
                    $student_lesson_video->student_id = $student->id;
                    $student_lesson_video->video_id = $video->id;
                    $student_lesson_video->lesson_id = $video->lesson_id;
                    $student_lesson_video->allowed = 1;
                    $student_lesson_video->total_views_till_now = 0;
                    $student_lesson_video->allowed_views = 10;
                    $student_lesson_video->remains_views = 10;
                    $student_lesson_video->user_id = Auth::id();
                    $student_lesson_video->save();
                }
            }

            
        }

        foreach ($student_course_units as $student_course_unit) {

            if (!in_array($student_course_unit, $request->units_id)) {
                $student_course_unit = StudentUnit::withTrashed()->where('student_id'  , $student->id )
                ->where('unit_id', $student_course_unit )->first();
                if ($student_course_unit) {
                    $student_course_unit->delete();
                    $videos = LessonVideo::whereHas('lesson' , function($query) use($unit_id) {
                        $query->where('unit_id'  , $unit_id );
                    })->get();
                // now we need to add lessons and videos to this student
                    foreach ($videos as $video) {
                        $student_video = StudentLesson::where('student_id' , $student->id )->where('lesson_id' , $video->lesson_id )->latest()->first();
                        if ($student_video) {
                            $student_video->delete();
                        }
                    }
                }
            }
        }
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
