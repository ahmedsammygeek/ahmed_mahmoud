<?php

namespace App\Http\Resources\Api\Student\V1\Library;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
use Number;
class LessonFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (Storage::exists('lesson_files/'.$this->lessonFile?->file)) {
             $file_size = Storage::size('lesson_files/'.$this->lessonFile?->file);
        } else {
             $file_size = 0 ;
        }
       
        return [
            'id' => $this->lesson_file_id , 
            'name' => $this->lessonFile?->name  != null ? $this->lessonFile?->name : $this->lessonFile?->file , 
            'allowed_views_number' => $this->allowed_views_number , 
            'allowed_downloads_number' => $this->allowed_downloads_number , 
            'can_view' => $this->allowed_views_number > 0 ?  true : false , 
            'can_download' => $this->allow_download == 1 ? true :  false   , 
            'force_water_mark' => $this->force_water_mark == 1 ? true : false , 
            'water_mark_text' => (string)$this->water_mark_text , 
            'file_size' => Number::fileSize($file_size), 
        ];
    }
}
