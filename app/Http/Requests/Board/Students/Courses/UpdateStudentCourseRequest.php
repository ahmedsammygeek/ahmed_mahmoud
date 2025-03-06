<?php

namespace App\Http\Requests\Board\Students\Courses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentCourseRequest extends FormRequest
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
            'group_id' => 'required' , 
            'force_headphones' => 'nullable', 
            'allow' => 'nullable', 
            'in_office' => 'nullable', 
            'show_phone_on_viedo' => 'nullable', 
            'speak_user_phone' => 'nullable', 
            'force_face_detecting' => 'nullable', 
            'office_library' => 'nullable', 
            'online_library' => 'nullable', 
            'units_id' => 'required' , 
        ];
    }
}
