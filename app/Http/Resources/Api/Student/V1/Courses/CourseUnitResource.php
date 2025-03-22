<?php

namespace App\Http\Resources\Api\Student\V1\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Student\V1\Courses\Units\UnitLessonResource;
use Carbon\CarbonInterval;
class CourseUnitResource extends JsonResource
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
            'lesson_mins' => '20 min'  , 
            'lesson_count' => $this->lessons()->count() ,  
        ];
    }
}
