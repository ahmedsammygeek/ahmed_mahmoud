<?php

namespace App\Http\Resources\Api\Student\V1\Exams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->question_id , 
            'content' => $this->question?->content , 
            'question_type' => $this->question?->type == 1 ? 'text' : 'image'  , 
            'answer_type' =>  $this->question?->answer_type == 1 ? 'choices' : 'content' , 
            'student_answer_id' => $this->answer_id , 
            'student_answer_content' => $this->answer_content , 
            'answers' => QuestionAnswerResource::collection($this->question?->answers) // empty when content  , 
        ];
    }
}
