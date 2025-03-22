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
        switch ($this->students_count_status) {
            case 1:
                $students_count = $this->students->count();
            break;
            case 2:
                $students_count = $this->fake_students_count;
            break;
            case 3:
                $students_count = null;
            break;
            
            default:
            break;
        }

        return [
            'id' => $this->id , 
            'title' => $this->title , 
            'image' => Storage::url('courses/'.$this->image) , 
            'price' => $this->price , 
            // 'total_mins' => $this->lessons()->sum('lesson_mins') , 
            'total_mins' => mt_rand(10 , 16) , 
            'rate' => 4.9 , 
            'students_count' => $students_count , 
            'content' => $this->content , 
            'dose_user_subscribed' => $this->dose_user_subscribed , 
            'user_progress' => 20 , 
            'teacher' => new CourseDetailsTeacherResource($this->teacher), 
            'units' => CourseUnitResource::collection($this->units) , 
            'contact_mobile' =>  $this->contact_mobile  , 
            'paid_amount' => 0 , 
            'remains' => 0 , 
            'due_date' => '19-3-2025' , 
            'remains_days' => 0 , 
            'show_course_payments' => false ,  
            'direct_register' => (bool) $this->direct_register , 
            'is_free' => (bool) $this->is_free , 
            'show_price' => (bool)$this->show_price,
        ]; 
    }
}
