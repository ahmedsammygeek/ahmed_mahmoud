<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\TeacherScope;
class Teacher extends Model
{
    use HasFactory  ;

    protected $table = 'users';


    protected static function booted()
    {
        static::addGlobalScope(new TeacherScope);
    }



    public function courses()
    {
        return $this->hasMany(CourseTeacher::class , 'teacher_id');
    }

    // suggested


    public function scopeSuggested($query) {
        
        $query->where('show_in_suggested_in_app', 1);
    }


}
