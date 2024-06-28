<?php

namespace App\Http\Requests\Api\Student\V1\Feedback;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Api\GeneralResponse;
class StoreFeedBackRequest extends FormRequest
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
            'content' => 'required' , 
        ];
    }
}
