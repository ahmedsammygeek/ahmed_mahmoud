<?php

namespace App\Http\Resources\Api\Student\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UniversityFacultyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->faculty_id , 
            'name' => $this->faculty?->name , 
            'levels' => UniversityFacultyLevelResource::collection($this->faculty?->levels) , 
        ];
    }
}
