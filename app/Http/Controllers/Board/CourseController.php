<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Grade  , EducationalSystem, Student , Teacher, Course  , CourseEducationalSystem };
use App\Http\Requests\Board\Courses\{ StoreCourseRequest , UpdateCourseRequest};
use App\Actions\Board\Courses\{ StoreCourseAction , UpdateCourseAction };
use Gate;
use Auth;
use App\Models\{CourseStudent , StudentUnit  , LessonVideo , StudentLesson };

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


    public function fix(Course $course)
    {

        $course_students = CourseStudent::where('course_id', $course->id )->get(); 

        $course_students->map(function($course_student){
            $student_course_units = StudentUnit::where('student_id' , $course_student->student_id )
            ->whereHas('unit' , function($query) use($course_student) {
                $query->where('course_id' , $course_student->course_id );
            })->pluck('unit_id')->toArray() ;
            $course_student->student_course_units = $student_course_units ;

            StudentUnit::where('student_id' , $course_student->student_id )
            ->whereHas('unit' , function($query) use($course_student) {
                $query->where('course_id' , $course_student->course_id );
            })->delete(); 


            StudentLesson::where('student_id' , $course_student->student_id )
            ->whereHas('lesson' , function($query) use($student_course_units) {
                $query->whereIn('unit_id' , $student_course_units );
            })->delete();
        });


        CourseStudent::where('course_id', $course->id )->delete(); 
        
        $default_course_options = get_default_course_options($course->id);
        $default_course_views = get_default_course_views($course->id);
        foreach ($course_students as $one_course_student) {
            $dose_students_has_this_course = CourseStudent::where('student_id' , $one_course_student->student_id )
            ->where('course_id', $course->id )->first();

            $student = Student::where('id' , $one_course_student->student_id )->first();
            if (!$dose_students_has_this_course) {
                $student_course = new CourseStudent;
                $student_course->user_id = Auth::id();
                $student_course->student_id = $student->id;
                $student_course->course_id = $course->id;
                $student_course->group_id = $one_course_student->group_id;
                $student_course->force_headphones =   $default_course_options['force_headphones'] ;
                $student_course->show_phone_on_viedo =  $default_course_options['show_phone_on_viedo'] ;
                $student_course->speak_user_phone =   $default_course_options['speak_user_phone'] ;
                $student_course->force_face_detecting = $default_course_options['force_face_detecting'] ;
                $student_course->online_library = 0;
                $student_course->allow = 1;
                $student_course->save();
                $student_units = [];
                foreach ($one_course_student->student_course_units as $one_unit) {
                    $student_units[] = new StudentUnit([
                        'student_id' => $student->id , 
                        'user_id' => Auth::id() , 
                        'unit_id' => $one_unit , 
                        'is_allowed' => 1 , 
                    ]);
                    $student->units()->saveMany($student_units);
                    $videos = LessonVideo::whereHas('lesson' , function($query) use( $one_course_student , $course ) {
                        $query->whereIn('unit_id' , $one_course_student->student_course_units );
                    })->get();
                    $student_lessons = [];
                    foreach ($videos as $video) {
                        $student_lessons[] = new StudentLesson([
                            'lesson_id' => $video->lesson_id , 
                            'user_id' => Auth::id(), 
                            'student_id' => $student->id , 
                            'allowed_views' => $default_course_views , 
                            'remains_views' => $default_course_views , 
                            'total_views_till_now' => 0  ,
                            'video_id' => $video->id
                        ]);
                    }
                    $student->lessons()->saveMany($student_lessons);
                }
            }

        }

        return redirect(route('board.courses.index'))->with('success' , 'تم حذف جميع الطلاب و ادخالهم الى المواد مره اخرى بنجاح' );
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
