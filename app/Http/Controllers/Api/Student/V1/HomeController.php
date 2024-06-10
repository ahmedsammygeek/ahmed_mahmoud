<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\Home\SlideResource;
use App\Http\Resources\Api\Student\Home\TeacherResource;
use App\Models\Slide;
use App\Models\Teacher;
use App\Models\CourseTeacherGroupStudent;
use App\Models\Course;
use Auth;

use App\Http\Resources\Api\Student\V1\Home\StudentCourseResource;
class HomeController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        $courses = Course::whereHas('teachers' , function($query) use($student) {
            $query->whereHas('groups' , function($query) use($student) {
                $query->whereHas('students' , function($query) use($student) {
                    $query->where('student_id' , $student->id );
                });
            });
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




        $suggested_courses = Course::query()
        ->where('grade_id' , $student->grade_id )
        ->whereNotIn('id' , $courses->pluck('id')->toArray())
        ->whereHas('educationalSystems' , function($query) use($student) {
            $query->where('educational_system_id' , $student->educational_system_id );
        })
        ->get();

         $suggested_courses->map(function($course) use ($student) {
            $course->dose_user_subscribed = CourseTeacherGroupStudent::where('student_id' , $student->id )
            ->whereHas('CourseTeacherGroup' , function($query) use($course) {
                $query->whereHas('CourseTeacher' , function($query) use($course) {
                    $query->where('course_id' , $course->id );
                });

            })->first() ? true : false ;
            return $course;
        });

        $slides = Slide::active()->latest()->get();
        $teachers = Teacher::suggested()->get();

        $data = [
            'slides' => SlideResource::collection($slides) , 
            'teachers' => TeacherResource::collection($teachers) , 
            'my_courses' => StudentCourseResource::collection($courses) , 
            'suggested_courses' => StudentCourseResource::collection($suggested_courses) , 
        ];

        return $this->response(
            data : $data , 
        );
    }
}
