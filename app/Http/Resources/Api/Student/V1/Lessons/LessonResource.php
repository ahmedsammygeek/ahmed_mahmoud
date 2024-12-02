<?php

namespace App\Http\Resources\Api\Student\V1\Lessons;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Student\V1\Exams\ExamResource;
use App\Http\Resources\Api\Student\V1\Library\LessonFileResource;
use Auth;
use App\Models\{CourseStudent , Setting , StudentLesson };
class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $settings = Setting::first();
        $student = Auth::guard('student')->user();
        $student_course = CourseStudent::where('student_id' , $student->id )->where('course_id' , $this->unit?->course_id )->latest()->first();
        $student_lesson = StudentLesson::where('student_id' , $student->id )->where('lesson_id' , $this->id )->first();

        $remains_views = $student_lesson ? $student_lesson->remains_views : 10;
        $show_phone_on_viedo = $student_course ? (bool)$student_lesson->show_phone_on_viedo : false;
        $speak_user_phone = $student_course ? (bool)$student_lesson->speak_user_phone : false;


        return [
            'id' => $this->id , 
            'title' => $this->title , 
            'content' => $this->content , 
            'lesson_mins' => $this->lesson_mins , 
            'remains_views_allowed' => $remains_views , 
            'show_phone_on_viedo_ervery' => $settings->show_phone_on_viedo_ervery , 
            'lesson_mins_to_be_mark_as_viewed' => $settings->default_seen_mints ,
            'files' => LessonFileResource::collection($this->files) , 
            'quizzes' =>  ExamResource::collection($this->exams)

        ];
    }
}
