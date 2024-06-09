<?php

namespace App\Http\Resources\Api\Student\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class SlideResource extends JsonResource
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
            'sub_title' => $this->subtitle , 
            'image' => Storage::url('slides/'.$this->image) , 
        ];
    }
}
