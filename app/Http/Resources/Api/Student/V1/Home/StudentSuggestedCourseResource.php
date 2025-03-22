<?php

namespace App\Http\Resources\Api\Student\V1\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class StudentSuggestedCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id  , 
            'title' => $this->title , 
            'image' => Storage::url('courses/'.$this->image) , 
            'total_mins' => mt_rand(20 , 140 ) , 
            'price' => $this->price , 
            'allowed' => $this->allowed , 
            'dose_user_subscribed' => false , 
            'not_allow_message' => $this->not_allow_message , 
            'is_free' => (bool)$this->is_free, 
            'show_course_price' => (bool)$this->show_price, 
        ];
    }
}
