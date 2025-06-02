<?php

namespace App\Http\Requests\Board\Students;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name' => 'required', 
            'mobile' => 'required|unique:students,mobile' , 
            'guardian_mobile' => 'nullable' , 
            'password' => 'required_if:student_type,2,3|confirmed' , 
            'grade' => 'required' , 
            'educational_system_id' => 'required' ,
            'student_type' => 'required' , 
            'is_banned' => 'nullable' , 

        ];
    }
}
