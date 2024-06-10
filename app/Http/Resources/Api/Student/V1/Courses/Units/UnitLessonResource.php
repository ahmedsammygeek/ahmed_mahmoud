<?php

namespace App\Http\Resources\Api\Student\V1\Courses\Units;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitLessonResource extends JsonResource
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
            'is_free' => $this->is_free == 1 ? true : false , 
            'lesson_mins' => $this->lesson_mins , 
            'lesson_video_link' => $this->lesson_video_link , 
            'lesson_video_driver' => $this->lesson_video_driver, 

        ];
    }
}
