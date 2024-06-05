<?php

namespace App\Http\Resources\Api\Student\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name , 
            'mobile' => $this->mobile , 
            'guardian_mobile' => $this->guardian_mobile , 
            'grade' => $this->grade , 
            'educational_system_id' => $this->educational_system_id , 
            'is_phone_verified' => $this->phone_verified_at ? true : false , 
            'is_banned' => $this->is_banned == 1 ? true : false , 
            'banning_message' => $this->banning_message , 
        ];
    }
}
