<?php

namespace App\Http\Requests\Api\Student\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class UpdateProfileRequest extends FormRequest
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
            'profile_picture' => 'nullable|image' , 
            'name' => 'required' , 
            'mobile' => 'required|phone:mobile,EG|unique:students,mobile,'.Auth::guard('student')->id() , 
            'type' => 'required' , 
            'faculty_id' => 'required_if:type,2',
            'university_id' => 'required_if:type,2',
            'faculty_level_id' => 'required_if:type,2',
            'grade' => 'required_if:type,1' , 
            'educational_system_id' => 'required_if:type,1' , 
            'guardian_mobile' => 'required_if:type,1' , 
        ];
    }
}
