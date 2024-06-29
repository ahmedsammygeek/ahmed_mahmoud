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
            'show_phone_on_viedo' => (bool)$this->show_phone_on_viedo ,
            'speak_user_phone' => (bool)$this->speak_user_phone ,
            'speak_user_phone_every' => $this->speak_user_phone_every ,
        ];
    }
}
