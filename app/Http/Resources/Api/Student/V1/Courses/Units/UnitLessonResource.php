<?php

namespace App\Http\Resources\Api\Student\V1\Courses\Units;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id , 
            'title' => $this->title , 
            'content' => $this->content , 
        ];
    }
}
