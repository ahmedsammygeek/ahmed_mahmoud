<?php

namespace App\Http\Resources\Api\Student\V1\Courses\Units\Lessons;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Student\V1\Exams\ExamResource;
use App\Http\Resources\Api\Student\V1\Library\LessonFileResource;
use Auth;
use App\Models\{CourseStudent , Setting };
class VideoResource extends JsonResource
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
        if ($student) {
            $student_course = CourseStudent::where('student_id' , $student->id )->where('course_id' , $this->lesson?->unit?->course_id )->latest()->first();
        } else {
            $student_course = null;
        }



        return [
            'id' => $this->id , 
            'title' => $this->title , 
            'content' => $this->content , 
            'lesson_mins' => $this->lesson_mins , 
            'lesson_video_link' => $this->lesson_video_link , 
            'lesson_video_driver' => $this->lesson_video_driver , 
            'lesson_video_id' => $this->video_id , 
            'remains_views_allowed' => $this->remains_views , 
            'show_phone_on_viedo' => $student_course ? (boolean)$student_course->show_phone_on_viedo : false ,
            'show_name_on_viedo' => $student_course ? (boolean)$student_course->show_name_on_viedo : false ,
            'speak_user_phone' => $student_course ? (boolean)$student_course->speak_user_phone : false ,
            'show_phone_on_viedo_ervery' => $settings->show_phone_on_viedo_ervery , 
            'lesson_mins_to_be_mark_as_viewed' => $settings->default_seen_mints ,
            'force_headphone' =>  $student_course ? (boolean)$student_course->force_headphones : false , 
            'force_face_detecting' =>  $student_course ? (boolean)$student_course->force_face_detecting : false , 
            'is_free' => (boolean)$this->is_free , 
            'total_views_remains' => 10 , 
            'total_allowed_views' => 20 , 
            // 'files' => LessonFileResource::collection($this->files) , 
            // 'quizzes' =>  ExamResource::collection($this->exams)
        ];
    }
}
