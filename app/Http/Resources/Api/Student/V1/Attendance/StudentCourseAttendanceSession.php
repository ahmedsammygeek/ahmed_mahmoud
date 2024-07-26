<?php

namespace App\Http\Resources\Api\Student\V1\Attendance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCourseAttendanceSession extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date' => $this->time_from->toDateTimeString() ,
        ];
    }
}
