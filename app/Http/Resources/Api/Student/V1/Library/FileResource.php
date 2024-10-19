<?php

namespace App\Http\Resources\Api\Student\V1\Library;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class FileResource extends JsonResource
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
            'name' => $this->lessonFile?->name  != null ? $this->lessonFile?->name : $this->lessonFile?->file , 
            'allowed_views_number' => $this->allowed_views_number , 
            'allowed_downloads_number' => $this->allowed_downloads_number , 
            'can_view' => $this->allowed_views_number > 0 ?  true : false , 
            'can_download' => $this->allowed_downloads_number > 0 ? true :  false   , 
            'force_water_mark' => $this->force_water_mark == 1 ? true : false , 
            'water_mark_text' => (string)$this->water_mark_text , 
            'path' => Storage::url('lesson_files/'.$this->lessonFile?->file), 
            
        ];
    }
}
