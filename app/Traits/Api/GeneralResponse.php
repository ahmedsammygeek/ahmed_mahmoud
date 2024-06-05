<?php

namespace App\Traits\Api;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

trait GeneralResponse
{


    public function response( $status = 'success' ,  $data = [] ,  $message = '' , $errors = [] , $statusCode = 200 )
    {
        return response()->json([
            'status' => $status , 
            'errors' => $errors  , 
            'data' => (object)$data , 
            'message' => $message , 
        ], $statusCode);
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'status' => 'error' , 
            'message' => trans('api.validation error') , 
            'errors' => $validator->errors() , 
            'data' => (object)[] , 

        ] , 422)); 
    }
}
