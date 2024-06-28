<?php

namespace App\Http\Resources\Api\Student\V1\Splashes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class SplashResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'content' => $this->content , 
            'image' => Storage::url('splashes/'.$this->image) , 
        ];
    }
}
