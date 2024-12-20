<?php

namespace App\Http\Requests\Api\Student\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Api\GeneralResponse;
class LoginRequest extends FormRequest
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
            'mobile' => 'required' , 
            'password' => 'required' , 
            'unique_device_id' => 'required_without:device_serial_number' , 
            'device_serial_number' => 'required_without:unique_device_id' , 
            'device_platform' => 'required' , 
            'device_serial_number' => 'nullable' , 
            'device_brand' => 'nullable' , 
            'firebase_fcm' => 'nullable', 
            'device_name' => 'nullable' , 

        ];
    }
}


