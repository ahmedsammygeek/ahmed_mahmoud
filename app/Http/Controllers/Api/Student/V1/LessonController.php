<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Course , Lesson  , StudentLesson  , LessonFile  , StudentUnit  , LessonVideo , Unit , StudentExam , Exam , CourseStudent };
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\V1\Lessons\LessonResource;
use App\Http\Resources\Api\Student\V1\Courses\ExamResource;
use Auth;
use App\Http\Resources\Api\Student\V1\Courses\CourseResource;
use App\Http\Resources\Api\Student\V1\Courses\CourseUnitResource;
use App\Http\Resources\Api\Student\V1\Courses\Units\UnitLessonResource;
use App\Http\Resources\Api\Student\V1\Courses\Units\Lessons\VideoResource;
use App\Http\Resources\Api\Student\V1\Lessons\LessonFileResource;
class LessonController extends Controller
{

    use GeneralResponse;


    public function watched(Course $course , Lesson $lesson , LessonVideo $video )
    {
        $student = Auth::guard('student')->user();
        $student_lesson = StudentLesson::where('student_id' , $student->id )
        ->where('video_id' , $video->id )
        ->latest()
        ->first();

        if ($student_lesson) {
            $student_lesson->total_views_till_now = $student_lesson->total_views_till_now + 1;
            $student_lesson->remains_views = $student_lesson->remains_views - 1;
            $student_lesson->save();
        }

        return $this->response(
            message : 'تم تحديد الفديو مشاهد منجاح'  , 
        );

    }


    public function show(Course $course , Unit $unit ,  Lesson $lesson )
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

        $videos = $lesson->videos()->orderBy('sorting' , 'ASC' )->get();
        $data = [
            'course' => new CourseResource($course)  , 
            'unit' => new CourseUnitResource($unit) , 
            'lesson' => new UnitLessonResource($lesson), 
            'videos' => VideoResource::collection($videos) , 
        ];


        return $this->response(
            data : $data , 
        );
        
    }


    /**
     * Display the specified resource.
     */
    public function show_video(Course $course , Unit $unit ,  Lesson $lesson  , LessonVideo $video)
    {

        // $student = Auth::guard('student')->user();

            // dd($student);

        // we need first to check if this lesson related to this course or not

        $course_lessons_ids = $course->lessons()->pluck('lessons.id')->toArray();



        if (!in_array($lesson->id, $course_lessons_ids)) {

            return $this->response(
                status : 'error' , 
                message: 'هذا الدرس غير موجود' , 
                statusCode : 404 ,
            );
        }

        // we need to check if this lesson is avialble to show  or not
        if (!$lesson->is_active) {
            return $this->response(
                status : 'error' , 
                message: 'هذا الدرس غير متاح للمشاهده فى الوقت الحالى' , 
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
            $data['video'] = new VideoResource($video);
            return $this->response(
                data : $data , 
            );
        } else {
            if (!Auth::guard('student')->check()) {
                return $this->response(
                    message : 'يجب الاشتارك فى هذا الكورس لمشاهده الدرس'  , 
                );
            }
        }

        $student = Auth::guard('student')->user();




        $course_student = CourseStudent::where('course_id' , $course->id )
        ->where('student_id' , $student->id )->first();

        if ($course_student->allow == 0 ) {
            return $this->response(
                status : 'error' , 
                message : ' تم منعك من مشاهده هذا الكورس بسبب  : '.$course_student->disable_reason  , 
            );
        }

        // now we need to check if this user has access to this unit or not

        $student_unit = StudentUnit::where('student_id' , $student->id )->where('unit_id' , $unit->id )->latest()->first();


  


        if ($student_unit?->is_allowed == 0) {
            return $this->response(
                status : 'error' , 
                message : 'انت غير مشترك بهذا الجزء , برجاء التواصل مع اداره التطبيق'  , 
            );
        }



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





        $student_lesson = StudentLesson::where('student_id' , $student->id )
        ->where('lesson_id' , $lesson->id )
        ->where('video_id' , $video->id )
        ->first();

        // dd($student_lesson , $student->id , $lesson->id );

        if (!$student_lesson || ($student_lesson->allowed == 0) ) {
            return $this->response(
                message : 'تم منعك من مشاهده هذ الدرس'  , 
            );
        }

        if ($student_lesson->remains_views > 0 ) {

            $student_course = CourseStudent::where('student_id' , $student->id )->where('course_id' , $course->id )->first();
            $data['video'] = new VideoResource($video);
            $data['files'] = LessonFileResource::collection($video->files);

            return $this->response(
                data : $data , 
            );
        } else {

            return $this->response(
                status : 'error' , 
                message : 'لقد تم استهلاك عدد المشاهدات المسموح لك به'  , 
            );
        }
    }

    public function viewed(LessonFile $lesson_file) {

        $data = [
            'available_views_count' => 2 , 
        ];

        return $this->response(
            message : 'تم مشاهده الملف بنجاح'  , 
            data : $data , 
        );
    }

    public function downloaded(LessonFile $lesson_file) {

        $data = [
            'can_download' => true , 
        ];

        return $this->response(
            message : 'تم تنزيل الملف بنجاح'  , 
            data : $data , 
        );
    }

}
