<?php

namespace App\Http\Resources\Api\Student\V1\StudentCourses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class StudentCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->course_id , 
            'progress' => $this->progress , 
            'title' => $this->course?->title , 
            'image' => Storage::url('courses/'.$this->course?->image) , 

        ];
    }
}
