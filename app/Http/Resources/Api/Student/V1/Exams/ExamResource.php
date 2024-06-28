<?php

namespace App\Http\Resources\Api\Student\V1\Exams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
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
            'starts_at' => $this->starts_at->toDateTimeString() , 
            'ends_at' => $this->ends_at->toDateTimeString() , 
            'duration' => $this->duration , 
            'can_user_re_exam' => (bool)$this->can_user_re_exam , 
            'min_degree_to_re_exam' => $this->min_degree_to_re_exam , 
            'total_degree' => $this->total_degree , 
            'can_student_see_result' => (bool)$this->can_student_see_result , 
            'questions_count' => $this->question_limit , 
        ];
    }
}
