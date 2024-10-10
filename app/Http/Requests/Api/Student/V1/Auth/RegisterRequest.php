<?php

namespace App\Http\Requests\Api\Student\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Api\GeneralResponse;
class RegisterRequest extends FormRequest
{
    use GeneralResponse;
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
            'name' => 'required' , 
            'password' => 'required|min:8|confirmed' , 
            'mobile' => 'required|unique:students,mobile' , 
            'guardian_mobile' => 'required_if:type,1|unique:students,guardian_mobile' , 
            'grade' => 'required_if:type,1' , 
            'educational_system_id' => 'required_if:type,1' , 
            'app_language' => 'required' , 
            'firebase_fcm' => 'required' , 
            'mobile_serial_number' => 'required' , 
            'app_platform' => 'required' , 
            'type' => 'required' , 
            'faculty_id' => 'required_if:type,2',
            'university_id' => 'required_if:type,2',
            'faculty_level_id' => 'required_if:type,2',
        ];
    }
}
