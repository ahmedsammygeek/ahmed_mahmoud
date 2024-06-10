<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Student\V1\Search\TeacherResource;
use App\Traits\Api\GeneralResponse;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\CourseTeacherGroupStudent;
use Auth;
use App\Http\Resources\Api\Student\V1\Teachers\TeacherDetailsResource;
use App\Http\Resources\Api\Student\V1\Teachers\CourseResource;
class TeacherController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::where('show_in_suggested_in_app' , 1 )->latest()->get();

        $data = [
            'teachers' => TeacherResource::collection($teachers) , 
        ];

        return $this->response(
            data : $data , 
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $student = Auth::guard('student')->user();
        $courses = Course::whereHas('teachers' , function($query) use($teacher) {
            $query->where('teacher_id' , $teacher->id );
        })->get();
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
            'teacher' => new TeacherDetailsResource($teacher)  , 
            'courses' => CourseResource::collection($courses) , 
        ];

        return $this->response(
            data : $data , 
        );
    }


}
