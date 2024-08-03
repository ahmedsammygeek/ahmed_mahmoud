<?php

namespace App\Http\Requests\Board\Exams;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'questions' => 'required|array|min:5' , 
            'course_id' => 'required' , 
            'pass_degree' => 'required' , 
            'title_ar' => 'required' , 
            'title_en' => 'required' , 
            'date' => 'required' , 
            'duration' => 'required' , 
            'question_limit' => 'required' , 
            'can_user_re_exam' => 'nullable' , 
            'can_student_see_result' => 'nullable' , 
            'min_degree_to_re_exam' => 'nullable' , 
            'retry_count' => 'nullable' , 
            'lesson_id' => 'nullable' , 
        ];
    }
}
