<?php

namespace App\Http\Requests\Board\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'name' => 'required' ,
            'image' => 'nullable' , 
            'password' => 'nullable' , 
            'mobile' => 'required' , 
            'bio' => 'required' , 
            'show_in_suggested_in_app' => 'nullable' , 
            'default_views_number' => 'nullable' , 
            'permissions' => 'nullable' , 
            'force_face_detecting' => 'nullable' , 
            'speak_user_phone' => 'nullable' , 
            'show_phone_on_viedo' => 'nullable' , 
            'force_headphones' => 'nullable' , 
            'default_library_views_number' => 'required' , 
            'default_library_download_number' => 'required' , 
        ];
    }
}
