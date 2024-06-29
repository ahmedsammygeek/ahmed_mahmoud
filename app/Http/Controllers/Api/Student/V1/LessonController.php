<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Course , CourseUnitLesson  , StudentLesson };
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\V1\Lessons\LessonResource;
use Auth;
class LessonController extends Controller
{

    use GeneralResponse;


    public function watched(Course $course , CourseUnitLesson $lesson )
    {
        $student = Auth::guard('student')->user();
        $student_lesson = StudentLesson::where('student_id' , $student->id )->where('course_unit_lesson_id' , $lesson->id )->first();

        if ($student_lesson) {
           $student_lesson->total_views_till_now = $student_lesson->total_views_till_now + 1;
           $student_lesson->remains_views = $student_lesson->remains_views - 1;
           $student_lesson->save();
        }

        return $this->response(
            message : 'lesson marked as watched successfully'  , 
        );
        
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Course $course , CourseUnitLesson $lesson )
    {
        // we need first to check if this lesson related to this course or not

        $course_lessons_ids = $course->lessons()->pluck('course_unit_lessons.id')->toArray();

        if (!in_array($lesson->id, $course_lessons_ids)) {

            return $this->response(
                status : 'error' , 
                message: 'this lessons is not exist' , 
                statusCode : 404 ,
            );
        }

        // we need to check if this lesson is avialble to show  or not
        if (!$lesson->is_active) {
            return $this->response(
                status : 'error' , 
                message: 'this lessons is not allowed to show right now' , 
                statusCode : 404 ,
            );
        }

        $student = Auth::guard('student')->user();

        // $student_lesson = StudentLesson::where('student_id' , $student->id )->where('course_unit_lesson_id' , $lesson->id )->first();

        if ($lesson->is_free) {

            $lesson['remains_views'] =  10;
            $data['lesson'] = new LessonResource($lesson);
            return $this->response(
                data : $data , 
            );
        }

        $student_lesson = StudentLesson::where('student_id' , $student->id )->where('course_unit_lesson_id' , $lesson->id )->first();

        if (!$student_lesson || ($student_lesson->allowed == 0) ) {
            return $this->response(
                message : 'you had been prevented to watch this lesson'  , 
            );
        }

        if ($student_lesson->remains_views > 0 ) {
            $student_lesson = StudentLesson::where('student_id' , $student->id )->where('course_unit_lesson_id' , $lesson->id )->first();
            $lesson['remains_views'] = $student_lesson ? $student_lesson->remains_views : 0;
            $data['lesson'] = new LessonResource($lesson);
            return $this->response(
                data : $data , 
            );
        } else {

            return $this->response(
                status : 'error' , 
                message : 'you have been exceeded the number of lesson views'  , 
            );
        }

        
    }


}
