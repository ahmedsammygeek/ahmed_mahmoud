<?php

namespace App\Http\Resources\Api\Student\V1\Search;

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
            'price' => $this->price , 
            'total_mins' => mt_rand(70  , 190) , 
            'rate' => 4.9 , 
            'students_count' => mt_rand(300 , 9000) , 
            'dose_user_subscribed' => $this->dose_user_subscribed, 
            'allowed' => $this->allowed , 
            'not_allow_message' => $this->not_allow_message , 
        ];
    }
}
