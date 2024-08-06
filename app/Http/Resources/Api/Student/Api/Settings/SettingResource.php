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
            'allow_virtual_apps' => (bool)$this->allow_virtual_apps ,
            'force_phone_verification' => (bool)$this->force_phone_verification , 
            'allow_developer_mode' => (bool)$this->allow_developer_mode , 
        ];
    }
}
