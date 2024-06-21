<?php

namespace App\Http\Requests\Board\Groups;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
            'course_teacher_id' => 'required' , 
            'starts_at' => 'required' , 
            'ends_at' => 'required' , 
            'maxmimam' => 'nullable' , 
            'active' => 'nullable' , 
            'days' => 'array|min:1' , 
            'days.*' => 'required' , 
            'from.*' => 'required' , 
            'to.*' => 'required'
        ];
    }
}
