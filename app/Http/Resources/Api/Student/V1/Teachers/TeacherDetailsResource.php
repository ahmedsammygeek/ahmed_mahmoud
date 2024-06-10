<?php

namespace App\Http\Resources\Api\Student\V1\Teachers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class TeacherDetailsResource extends JsonResource
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
            'name' => $this->name , 
            'image' => Storage::url('teachers/'.$this->image) , 
            'bio' => $this->bio , 
            'courses_count' => 3 , 
            'experience' => rand(2 , 8) , 
            'student_count' =>  mt_rand(300 , 9000) , 
        ];
    }
}
