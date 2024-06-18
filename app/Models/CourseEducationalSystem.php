<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEducationalSystem extends Model
{
    use HasFactory;


    protected $fillable = ['course_id' , 'educational_system_id' , 'user_id'];


    public function educationalSystem()
    {
        return $this->belongsTo(EducationalSystem::class , 'educational_system_id');
    }


    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id');
    }
}
