<?php

namespace App\Http\Resources\Api\Student\V1\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class CourseResource extends JsonResource
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
            'image' => Storage::url('courses/'.$this->image) , 
            'total_mins' => mt_rand(20 , 140 ) , 
            'price' => $this->price , 
            'dose_user_subscribed' => $this->dose_user_subscribed
        ];
    }
}
