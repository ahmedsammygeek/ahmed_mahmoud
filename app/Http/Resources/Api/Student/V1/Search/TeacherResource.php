<?php

namespace App\Http\Resources\Api\Student\V1\Search;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class TeacherResource extends JsonResource
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
            'name' => $this->name , 
            'image' => Storage::url('teachers/'.$this->image ) , 
            'total_students' => mt_rand(200 , 7800)
        ];
    }
}