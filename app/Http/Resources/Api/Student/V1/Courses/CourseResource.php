<?php

namespace App\Http\Resources\Api\Student\V1\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
use Auth;
class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $allowed = 1;
        $message = '';
        if (Auth::guard('student')->check()) {
            $student = Auth::guard('student')->user();
        }

        return [
            'id' => $this->id , 
            'title' => $this->title , 
            'image' => Storage::url('courses/'.$this->image) , 
            'total_mins' => mt_rand(20 , 140 ) , 
            'price' => $this->price , 
            'dose_user_subscribed' => $this->dose_user_subscribed , 
            'is_free' => (bool) $this->is_free , 
            'show_price' => (bool)$this->show_price,
        ];
    }
}
