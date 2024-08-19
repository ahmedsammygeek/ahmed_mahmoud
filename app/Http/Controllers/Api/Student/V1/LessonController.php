<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Course , Lesson  , StudentLesson  , LessonFile , StudentExam , Exam , CourseStudent };
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\V1\Lessons\LessonResource;
use App\Http\Resources\Api\Student\V1\Courses\ExamResource;
use Auth;
class LessonController extends Controller
{

    use GeneralResponse;


    public function watched(Course $course , Lesson $lesson )
    {
        $student = Auth::guard('student')->user();
        $student_lesson = StudentLesson::where('student_id' , $student->id )->where('lesson_id' , $lesson->id )->first();

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
    public function show(Course $course , Lesson $lesson )
    {


        // we need first to check if this lesson related to this course or not

        $course_lessons_ids = $course->lessons()->pluck('lessons.id')->toArray();



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

        

        // $student_lesson = StudentLesson::where('student_id' , $student->id )->where('course_unit_lesson_id' , $lesson->id )->first();

        if ($lesson->is_free) {
            $lesson['remains_views'] =  10;
            if (Auth::guard('student')->check()) {

                
        $student = Auth::guard('student')->user();

                $student_course = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )->first();

                $lesson['show_phone_on_viedo'] =  $student_course ? (bool)$student_course->show_phone_on_viedo :   false;
                $lesson['speak_user_phone'] =  $student_course ? (bool)$student_course->speak_user_phone :   false;
            } else {
                $lesson['show_phone_on_viedo'] =  false;
                $lesson['speak_user_phone'] =  false;
            }
            $data['lesson'] = new LessonResource($lesson);
            return $this->response(
                data : $data , 
            );
        } else {
            if (!Auth::guard('student')->check()) {
                return $this->response(
                    message : 'you need to purchase this course first to whach the lesson '  , 
                );
            }
        }

        $student = Auth::guard('student')->user();


        // we need to check if the student take the exam or not
        // we need to check if this the first lesson or not
        if ($course->lessons()->first()?->id != $lesson->id ) {
            $exam = Exam::where('lesson_id' , $lesson->id )->first();


            if ($exam)  {

                $student_exam = StudentExam::where('student_id' , $student->id )->where('exam_id', $exam->id )->where('is_finished' , 1 )->latest()->first();

                if ($student_exam) {

                    if (  $exam->pass_degree > (($student_exam->total_degree / $exam->total_degree ) * 100 )) {
                        return $this->response(
                            message : 'you did not passed the exam for the previous lesson please pass it first then you can watch this lesson '  , 
                        );
                    }

                } else {
                    return $this->response(
                        message : 'you need to pass the previous lesson exams first to lock this lesson'  , 
                    );
                }

            }

        }





        $student_lesson = StudentLesson::where('student_id' , $student->id )->where('lesson_id' , $lesson->id )->first();

        if (!$student_lesson || ($student_lesson->allowed == 0) ) {
            return $this->response(
                message : 'you had been prevented to watch this lesson'  , 
            );
        }

        if ($student_lesson->remains_views > 0 ) {

            $student_course = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )->first();

            $student_lesson = StudentLesson::where('student_id' , $student->id )->where('lesson_id' , $lesson->id )->first();
            $lesson['remains_views'] = $student_lesson ? $student_lesson->remains_views : 10;
            $lesson['show_phone_on_viedo'] = $student_course ? (bool)$student_lesson->show_phone_on_viedo : false;
            $lesson['speak_user_phone'] = $student_course ? (bool)$student_lesson->speak_user_phone : false;
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

    public function viewed(LessonFile $lesson_file) {

        $data = [
            'available_views_count' => 2 , 
        ];

        return $this->response(
            message : 'file viewed successfully'  , 
            data : $data , 
        );
    }

    public function downloaded(LessonFile $lesson_file) {

        $data = [
            'can_download' => true , 
        ];

        return $this->response(
            message : 'file downloaded successfully'  , 
            data : $data , 
        );
    }

}
