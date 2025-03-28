<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Models\{Course , CourseStudent  , Exam , Group , StudentLesson , Unit };
use App\Http\Resources\Api\Student\V1\Courses\CourseResource;
use Auth;
use Log;
use App\Http\Resources\Api\Student\V1\Courses\CourseDetailsResource;
use App\Http\Resources\Api\Student\V1\Courses\ExamResource;
use App\Http\Resources\Api\Student\V1\Courses\CourseUnitResource;
use App\Http\Resources\Api\Student\V1\Courses\Units\UnitLessonResource;

// CourseResource
// CourseUnitResource
// UnitLessonResource
class CourseController extends Controller
{
    use GeneralResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        if (Auth::guard('student')->check()) {
            $student = Auth::guard('student')->user();    
            $courses = Course::query()
            ->where('is_active' , 1 )
            ->where('grade_id' , $student->grade_id )
            ->whereHas('educationalSystems' , function($query) use($student) {
                $query->where('educational_system_id' , $student->educational_system_id );
            })
            ->get();
            $courses->map(function($course) use ($student) {
                $course->dose_user_subscribed = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )
                ->first() ? true : false ;
                return $course;
            });

        } else {
            $courses = Course::query()->where('is_active', 1)->get();
            $courses->map(function($course)  {
                $course->dose_user_subscribed = false ;
                return $course;
            });
        }

        $data = [
            'courses' => CourseResource::collection($courses) , 
        ];

        return $this->response(
            data : $data , 
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {   
        $is_user = false;
        if (Auth::guard('student')->check()) {
            $is_user = true;
            $student = Auth::guard('student')->user();
            $course['dose_user_subscribed'] = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )
            ->first() ? true : false ;
        } else {
            $course['dose_user_subscribed'] = false ;
        }
        $exams = Exam::where('course_id' , $course->id )->where('lesson_id' , null )->get();
        $data = [
            'course' => new CourseDetailsResource($course)  , 
            'exams' => $is_user ?  ExamResource::collection($exams) : [] , 
        ];
        return $this->response(
            data : $data , 
        );
    }


    public function units(Course $course)
    {
        $is_user = false;
        if (Auth::guard('student')->check()) {
            $is_user = true;
            $student = Auth::guard('student')->user();
            $course['dose_user_subscribed'] = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )
            ->first() ? true : false ;
        } else {
            $course['dose_user_subscribed'] = false ;
        }

        $units = $course->units()->where('is_active' , 1 )->get();

        $data = [
            'course' => new CourseResource($course)  , 
            'units' => CourseUnitResource::collection($units) , 
        ];

        return $this->response(
            data : $data , 
        );
    }

    public function unit_lessons(Course $course , Unit $unit)
    {

        $is_user = false;
        if (Auth::guard('student')->check()) {
            $is_user = true;
            $student = Auth::guard('student')->user();
            $course['dose_user_subscribed'] = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )
            ->first() ? true : false ;
        } else {
            $course['dose_user_subscribed'] = false ;
        }

        $lessons = $unit->lessons()->orderBy('sorting' , 'ASC' )->get();
        $data = [
            'course' => new CourseResource($course)  , 
            'unit' => new CourseUnitResource($unit) , 
            'lessons' => UnitLessonResource::collection($lessons), 
        ];

        return $this->response(
            data : $data , 
        );
    }

    public function subscribe(Course $course)
    {
        $student = Auth::guard('student')->user();

        $student_course = CourseStudent::where([
            ['course_id' , '=' , $course->id ] , 
            ['student_id' , '=' , $student->id ]
        ])->first();


        if ($student_course) {
            return $this->response(
                status : false , 
                message : 'انت مشترك بالفع فى هذاف الكورس'
            );
        }

        // $student_course = new CourseStudent;
        // $student_course->user_id = Auth::id();
        // $student_course->student_id = $student->id;
        // $student_course->course_id = $course->id;
        // // $student_course->group_id =  $group_id;
        // $student_course->save();


        // $course_lessons = $course->lessons()->pluck('lessons.id')->toArray();
        // $student_lessons = [];
        // foreach ($course_lessons as $course_lesson) {
        //     $student_lessons[] = new StudentLesson([
        //         'lesson_id' => $course_lesson , 
        //         'user_id' => null, 
        //         'student_id' => $student->id , 
        //         'allowed_views' => $course->default_view_number , 
        //         'remains_views' => $course->default_view_number , 
        //         'total_views_till_now' => 0  ,
        //     ]);
        // }
        // $student->lessons()->saveMany($student_lessons);


        return $this->response(
            message : 'برجاء التواصل مع اداره التطبيق'
        );

    }


}
