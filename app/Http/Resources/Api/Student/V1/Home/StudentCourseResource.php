<?php

namespace App\Http\Resources\Api\Student\V1\Home;

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
            'id' => $this->course_id  , 
            'title' => $this->course?->title , 
            'image' => Storage::url('courses/'.$this->course?->image) , 
            'total_mins' => mt_rand(20 , 140 ) , 
            'price' => $this->course?->price , 
            'allowed' => (bool)$this->allow , 
            'force_headphones' => (bool)$this->force_headphones , 
            'dose_user_subscribed' => true , 
            'not_allow_message' => $this->not_allow_message
        ];
    }
}
