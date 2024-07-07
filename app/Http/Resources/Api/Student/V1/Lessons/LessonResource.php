<?php

namespace App\Http\Resources\Api\Student\V1\Lessons;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id , 
            'title' => $this->title , 
            'content' => $this->content , 
            'lesson_mins' => $this->lesson_mins , 
            'lesson_video_link' => $this->lesson_video_link , 
            'lesson_video_driver' => $this->lesson_video_driver , 
            'lesson_video_id' => $this->video_id , 
            'remains_views_allowed' => $this->remains_views , 
            'show_phone_on_viedo' => true ,
            'speak_user_phone' => true ,
            'lesson_mins_to_be_mark_as_viewed' => 10 ,
            'files' => LessonFileResource::collection($this->files) , 

        ];
    }
}
