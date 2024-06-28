<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseStudent;
use App\Http\Resources\Api\Student\V1\StudentCourses\StudentCourseResource;
use Auth;
use App\Traits\Api\GeneralResponse;
class StudentCourseController extends Controller
{

    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function on_going()
    {
        $student = Auth::guard('student')->user();
        $student_courses = CourseStudent::with('course')->where('student_id' , $student->id )->where('progress' , '<' , 100  )->get();
        $data['courses'] = StudentCourseResource::collection($student_courses);

        return $this->response(
            data : $data , 
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function completed()
    {
        $student = Auth::guard('student')->user();
        $student_courses = CourseStudent::with('course')->where('student_id' , $student->id )->where('progress' , 100  )->get();
        $data['courses'] = StudentCourseResource::collection($student_courses);

        return $this->response(
            data : $data , 
        );
    }

}
