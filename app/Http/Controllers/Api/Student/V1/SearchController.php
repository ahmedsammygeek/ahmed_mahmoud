<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\CourseTeacherGroupStudent;
use App\Traits\Api\GeneralResponse;
use Auth;
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
        $student = Auth::guard('student')->user();
        $courses = Course::where('title->ar' , 'LIKE' , '%'.$request->keywords.'%' )->orWhere('title->ar' , 'LIKE' , '%'.$request->keywords.'%' )->get();
        $courses->map(function($course) use ($student) {
            $course->dose_user_subscribed = CourseTeacherGroupStudent::where('student_id' , $student->id )
            ->whereHas('CourseTeacherGroup' , function($query) use($course) {
                $query->whereHas('CourseTeacher' , function($query) use($course) {
                    $query->where('course_id' , $course->id );
                });

            })->first() ? true : false ;
            return $course;
        });



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
