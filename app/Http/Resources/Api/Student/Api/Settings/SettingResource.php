<?php

namespace App\Http\Resources\Api\Student\Api\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'lesson_mins_to_be_viewed' => $this->lesson_mins_to_be_viewed ,
            'allow_virtual_apps' => (bool)$this->allow_virtual_apps ,
        ];
    }
}
