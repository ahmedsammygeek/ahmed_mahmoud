<?php

namespace App\Http\Resources\Api\Student\V1\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class CourseDetailsTeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->teacher_id , 
            'name' => $this->teacher?->name , 
            'image' => Storage::url('teachers/'.$this->teacher?->image)
        ];;
    }
}
