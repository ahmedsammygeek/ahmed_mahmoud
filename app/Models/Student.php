<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Scopes\StudentScope;

class Student extends Authenticatable
{
    use  Notifiable , HasApiTokens , SoftDeletes ;



    // /**
    //  * The "booted" method of the model.
    //  */
    // protected static function booted(): void
    // {
    //     static::addGlobalScope(new StudentScope);
    // }


    
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


    public function courses()
    {
        return $this->hasMany(CourseStudent::class , 'student_id');
    }

    public function groups()
    {
        return $this->hasMany(GroupStudent::class , 'student_id');
    }

    public function lessons()
    {
        return $this->hasMany(StudentLesson::class , 'student_id');
    }


    public function units()
    {
        return $this->hasMany(StudentUnit::class , 'student_id');
    }


    public function payments()
    {
        return $this->hasMany(StudentPayment::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class , 'university_id');
    }


    public function faculty()
    {
        return $this->belongsTo(Faculty::class , 'faculty_id');
    }


    public function facultyLevel()
    {
        return $this->belongsTo(FacultyLevel::class , 'faculty_level_id');
    }


    public function LessonsFilesViews()
    {
        return $this->hasMany(LessonFileView::class , 'student_id');
    }


    public function deletedBy()
    {
        return $this->belongsTo(User::class , 'deleted_by');
    }

}
