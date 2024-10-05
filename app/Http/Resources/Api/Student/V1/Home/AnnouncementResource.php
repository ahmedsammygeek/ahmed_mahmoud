<?php

namespace App\Http\Resources\Api\Student\V1\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class AnnouncementResource extends JsonResource
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
            'content' => $this->type == 1 ? $this->content : Storage::url('announcements/'.$this->content) , 
            'type' => $this->type == 1 ? 'text' : 'image' , 
        ];
    }
}
