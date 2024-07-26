<?php

namespace App\Http\Resources\Api\Student\V1\Attendance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCourseAttendance extends JsonResource
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
            'sessions' => StudentCourseAttendanceSession::collection($this->sessions)  , 
        ];
    }
}
