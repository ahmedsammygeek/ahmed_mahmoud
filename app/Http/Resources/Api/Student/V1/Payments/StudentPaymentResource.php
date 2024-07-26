<?php

namespace App\Http\Resources\Api\Student\V1\Payments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'course' => $this->course?->title , 
            'amount' => $this->amount , 
            'created_at' => $this->created_at->toDateTimeString() , 
            'type' =>  $this->type == 1 ? 'course cost' : 'papers' , 
            'notes' => 'some notes here' , 
        ];
    }
}
