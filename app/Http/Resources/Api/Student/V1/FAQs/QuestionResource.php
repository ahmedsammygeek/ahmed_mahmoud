<?php

namespace App\Http\Resources\Api\Student\V1\FAQs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title , 
            'content' => $this->content , 
        ];
    }
}
