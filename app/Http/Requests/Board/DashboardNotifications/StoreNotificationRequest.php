<?php

namespace App\Http\Requests\Board\DashboardNotifications;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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
            'title_en' => 'required' , 
            'title_ar' => 'required' , 
            'content_en' => 'required' , 
            'content_ar' => 'required' , 
        ];
    }
}