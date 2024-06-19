<?php

namespace App\Http\Requests\Board\Courses\Units\Lessons;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
            'title_ar' => 'required' , 
            'title_en' => 'required' , 
            'description_en' => 'required' , 
            'description_ar' => 'required' , 
            'files' => 'nullable' , 
            'files.*' => 'pdf' , 
            'is_free' => 'nullable' , 
            'is_active' => 'nullable' , 
        ];
    }
}
