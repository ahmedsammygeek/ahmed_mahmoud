<?php

namespace App\Http\Resources\Api\Student\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
use App\Http\Resources\Api\Student\V1\UserUniversityResource;
use App\Http\Resources\Api\Student\V1\FacultyResource;
use App\Http\Resources\Api\Student\V1\UserFacultyLevelResource; 

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name , 
            'mobile' => $this->mobile , 
            'guardian_mobile' => $this->guardian_mobile , 
            'grade' => $this->grade_id , 
            'educational_system_id' => $this->educational_system_id , 
            'is_phone_verified' => $this->phone_verified_at ? true : false , 
            'is_banned' => $this->is_banned == 1 ? true : false , 
            'banning_message' => $this->banning_message , 
            'profile_picture' => Storage::url('students/'.$this->profile_picture) , 
            'type' => $this->type , 
            'university' => new UserUniversityResource($this->university) , 
            'faculty' => new FacultyResource($this->faculty) , 
            'faculty_level' => new UserFacultyLevelResource($this->facultyLevel) , 
        ];
    }
}
