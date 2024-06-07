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
            'educational_system_id' => 'required' , 
            'grade' => 'required' , 
            'name' => 'required' , 
            'mobile' => 'required|phone:mobile,EG|unique:students,mobile,'.Auth::guard('student')->id() , 
        ];
    }
}
