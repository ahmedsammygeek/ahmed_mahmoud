<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Course , Teacher , CourseStudent };

use App\Traits\Api\GeneralResponse;
use Auth;
use Str;
use DB;
use App\Http\Resources\Api\Student\V1\Search\CourseResource;
use App\Http\Resources\Api\Student\V1\Search\TeacherResource;
class SearchController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keywords = Str::lower($request->keywords);

        $courses = Course::where('title' , 'like' , '%'.$keywords.'%' )
        ->get();
        if (Auth::guard('student')->check()) {
            $student = Auth::guard('student')->user();

            $courses->map(function($course) use ($student) {
                $course_student = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )
                ->first();
                $course->dose_user_subscribed = $course_student ? true : false ;
            $course->allowed = $course_student ? (bool)$course_student->allow : true ;
            $course->not_allow_message = $course_student ? (bool)$course_student->disable_reason : '';
                return $course;
            });
        } else {
            $courses->map(function($course)  {
                $course->dose_user_subscribed = false ;
                $course->allowed = true ;
                $course->not_allow_message = '' ;
                return $course;
            });
        }




        $teachers = Teacher::where('name' , 'LIKE' , '%'.$request->keywords.'%' )->get();

        $data = [
            'courses' => CourseResource::collection($courses) , 
            'teachers' => TeacherResource::collection($teachers) , 
        ];


        return $this->response(
            data : $data , 
        );

    }


}
