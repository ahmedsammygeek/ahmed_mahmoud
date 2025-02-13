<?php

namespace App\Http\Resources\Api\Student\V1\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
use App\Http\Resources\Api\Student\V1\Courses\CourseDetailsTeacherResource;
use App\Http\Resources\Api\Student\V1\Courses\CourseUnitResource;
class CourseDetailsResource extends JsonResource
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
            // 'total_mins' => $this->lessons()->sum('lesson_mins') , 
            'total_mins' => mt_rand(10 , 16) , 
            'rate' => 4.9 , 
            'students_count' => $this->students->count() , 
            'content' => $this->content , 
            'dose_user_subscribed' => $this->dose_user_subscribed , 
            'user_progress' => 20 , 
            'teacher' => new CourseDetailsTeacherResource($this->teacher), 
            'units' => CourseUnitResource::collection($this->units) , 
            'contact_mobile' =>  $this->contact_mobile  , 
            'paid_amount' => 0 , 
            'remains' => 0 , 
            'due_date' => null , 
            'remains_days' => 14 , 
            'show_course_payments' => false ,  
        ]; 
    }
}
