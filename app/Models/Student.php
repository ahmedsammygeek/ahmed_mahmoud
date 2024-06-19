<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
 
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Student extends Authenticatable
{
    use  Notifiable , HasApiTokens ;
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function grade()
    {
        return $this->belongsTo(Grade::class , 'grade_id');
    }


    public function educationalSystem()
    {
        return $this->belongsTo(EducationalSystem::class , 'educational_system_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' );
    }


    public function loginDevices()
    {
        return $this->hasMany(StudentLoginDevice::class , 'student_id');
    }

    // protected function profile_picture() :Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $value == null ? 'student_default.png' : $value  ,
    //     );
    // }

}
