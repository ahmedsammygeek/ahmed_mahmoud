<?php

namespace App\Http\Requests\Board\Questions;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_id' => 'required' , 
            'is_active' => 'nullable' , 
            'content' => 'required' , 
            'answer_type' => 'required' , 
            'question_type' => 'required' , 
        ];
    }
}
