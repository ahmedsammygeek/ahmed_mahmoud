<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{CourseStudent , Group, StudentInstallment , Student , Course , StudentUnit , StudentPayment ,  StudentLesson , LessonVideo};


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


    public function store(Request $request , Student $student)
    {



        foreach ($request->courses as $one_course) {



            $dose_students_has_this_course = CourseStudent::where('student_id' , $student->id )
            ->where('course_id', $one_course )->first();
            if (!$dose_students_has_this_course) {
                $default_course_options = get_default_course_options($one_course);
                $default_course_views = get_default_course_views($one_course);

                $user_id = Auth::id();
                $student_course = new CourseStudent;
                $student_course->user_id = Auth::id();
                $student_course->student_id = $student->id;
                $student_course->course_id = $one_course;
                $student_course->group_id = $request->groups[$one_course];
                $student_course->in_office = 1;
                $student_course->office_library = 1;
                $student_course->online_library = $request->filled('online_library.'.$one_course) ? 1 : 0 ;
                $student_course->is_online = 1;
                $student_course->force_face_detecting = $default_course_options['force_face_detecting']  ;
                $student_course->speak_user_phone = $default_course_options['speak_user_phone']  ;
                $student_course->show_phone_on_viedo = $default_course_options['show_phone_on_viedo']  ;
                $student_course->force_headphones = $default_course_options['force_headphones']  ;
                $student_course->save();
                $student_units = [];
                foreach ($request->student_units[$one_course] as $student_unit) {

                    $student_units[] = new StudentUnit([
                        'student_id' => $student->id , 
                        'user_id' => Auth::id() , 
                        'unit_id' => $student_unit , 
                        'is_allowed' => 1 , 
                    ]);
                }
                $student->units()->saveMany($student_units);
                $course = Course::find($one_course);
                $videos = LessonVideo::whereHas('lesson' , function($query) use($request , $one_course ) {
                    $query->whereIn('unit_id' , $request->student_units[$one_course] );
                })->get();
                $student_lessons = [];
                foreach ($videos as $video) {
                    $student_lessons[] = new StudentLesson([
                        'lesson_id' => $video->lesson_id , 
                        'user_id' => $user_id, 
                        'student_id' => $student->id , 
                        'allowed_views' => $default_course_views , 
                        'remains_views' =>  $default_course_views , 
                        'total_views_till_now' => 0  ,
                        'video_id' => $video->id
                    ]);
                }
                $student->lessons()->saveMany($student_lessons);

                $student_payment = new StudentPayment;
                $student_payment->student_id = $student->id;
                $student_payment->user_id = Auth::id();
                $student_payment->course_id = $one_course;
                $student_payment->type = 1; 
                $student_payment->amount = $request->paid[$one_course];
                $student_payment->save();
                if ($request->filled('installment_months.'.$one_course)) {
                    for ($i=0; $i < count($request->installment_months[$one_course]) ; $i++) { 
                        $student_installment = new StudentInstallment;
                        $student_installment->user_id = Auth::id();
                        $student_installment->student_id = $student->id;
                        $student_installment->course_id = $one_course ;
                        $student_installment->amount = $request->installment_amounts[$one_course][$i];
                        $student_installment->due_date = $request->installment_months[$one_course][$i];
                        $student_installment->is_paid = 0;
                        $student_installment->student_payment_id = null;
                        $student_installment->change_to_paid_by = null;
                        $student_installment->save();
                    }
                }

            }        
        }


        return redirect(route('board.students.courses.index' , $student))->with('success' , trans('courses.courses addedd successfully' ) );
    }


    public function create(Student $student)  {

        return view('board.students.courses.create' , compact('student') );
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
