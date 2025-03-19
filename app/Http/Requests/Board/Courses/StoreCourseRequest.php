<?php

namespace App\Http\Requests\Board\Courses;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'image' => 'required' , 
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
            'direct_register' => 'nullable' , 
            'students_count_status' => 'nullable' , 
            'fake_students_count' => 'nullable' , 
            'force_face_detecting' => 'nullable' , 
            'speak_user_phone' => 'nullable' , 
            'show_phone_on_viedo' => 'nullable' , 
            'force_headphones' => 'nullable' , 
        ];
    }
}
