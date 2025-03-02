<?php

namespace App\Http\Requests\Board\Library;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'files' => 'required' , 
            'files.*' => 'mimes:pdf' , 
            'download_allowed_number' => 'required' , 
            'allowed_views_number' => 'required' , 
            'force_water_mark' => 'nullable' , 
            'students' => 'required'  ,  
        ];
    }
}
