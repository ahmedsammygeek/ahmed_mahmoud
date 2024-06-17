<?php

namespace App\Http\Requests\Board\Slides;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlideRequest extends FormRequest
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
            'sort' => 'nullable' , 
            'title_ar'  => 'nullable' , 
            'title_en' => 'nullable' , 
            'subtitle_en' => 'nullable' , 
            'subtitle_en' => 'nullable' , 
            'active' => 'nullable'
        ];
    }
}
