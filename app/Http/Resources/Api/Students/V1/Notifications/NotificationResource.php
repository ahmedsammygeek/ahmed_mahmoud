<?php

namespace App\Http\Resources\Api\Students\V1\Notifications;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'content' => $this['data']['content'] , 
            'course_id' => $this['data']['course_id'] , 
            'lesson_id' => $this['data']['lesson_id'] , 
            'exam_id' => $this['data']['exam_id'] , 
            'image' => $this['data']['image'] , 
            'is_read' => $this->read_at ? true : false , 
            'created_at' => $this->created_at->diffForHumans() , 

        ];
    }
}
