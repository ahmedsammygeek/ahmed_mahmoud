<?php

namespace App\Http\Requests\Board\Library;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends FormRequest
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
            'course_id' => 'required' , 
            'unit_id' => 'required' , 
            'lesson_id' => 'required' , 
            'video_id' => 'nullable' , 

        ];
    }
}
