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
            'allowed' => false , 
            'dose_user_subscribed' => false , 
            'not_allow_message' => null
        ];
    }
}