<?php

namespace App\Http\Requests\Board\Courses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'image' => 'nullable' , 
            'title_ar' => 'required' , 
            'title_en' => 'required' , 
            'content_ar' => 'required' , 
            'content_en' => 'required' , 
            'price' => 'required' , 
            'teacher_id' => 'required' , 
            'educational_system_id' => 'required' , 
            'grade' => 'required' , 
            'default_view_number' => 'nullable' , 
            'contact_mobile' => 'required' , 
            
        ];
    }
}
