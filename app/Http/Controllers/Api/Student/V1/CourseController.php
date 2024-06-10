<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Models\Course;
use App\Http\Resources\Api\Student\V1\Courses\CourseResource;
use Auth;
use App\Models\CourseTeacher;
use App\Models\CourseTeacherGroupStudent;
use App\Http\Resources\Api\Student\V1\Courses\CourseDetailsResource;

class CourseController extends Controller
{
    use GeneralResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();

        $courses = Course::query()
        ->where('grade_id' , $student->grade_id )
        ->whereHas('educationalSystems' , function($query) use($student) {
            $query->where('educational_system_id' , $student->educational_system_id );
        })
        ->get();


        $courses->map(function($course) use ($student) {
            $course->dose_user_subscribed = CourseTeacherGroupStudent::where('student_id' , $student->id )
            ->whereHas('CourseTeacherGroup' , function($query) use($course) {
                $query->whereHas('CourseTeacher' , function($query) use($course) {
                    $query->where('course_id' , $course->id );
                });

            })->first() ? true : false ;
            return $course;
        });


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
        $data = [
            'course' => new CourseDetailsResource($course)  , 
        ];

        return $this->response(
            data : $data , 
        );
        
    }

  
}
