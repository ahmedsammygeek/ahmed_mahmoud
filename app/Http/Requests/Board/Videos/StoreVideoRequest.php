<?php

namespace App\Http\Requests\Board\Videos;

use Illuminate\Foundation\Http\FormRequest;
use Alaouy\Youtube\Rules\ValidYoutubeVideo;
class StoreVideoRequest extends FormRequest
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
            'video_type' => 'required' , 
            'video_link' => [
                new ValidYoutubeVideo , 
                'required'
            ] , 
            'title_ar' => 'required' , 
            'title_en' => 'required' , 
            'description_ar' => 'required' , 
            'description_en' => 'required' , 
            'allowed_views' => 'required' , 
            'is_free' => 'nullable' , 
            'is_active' => 'nullable' , 
            'files' => 'nullable' , 
            'files.*' => 'mimes:pdf' , 
        ];
    }
}
