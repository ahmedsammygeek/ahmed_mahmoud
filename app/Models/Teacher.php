<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\TeacherScope;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Teacher extends Authenticatable
{
    use HasFactory , HasRoles  ;

    protected $table = 'users';


    protected static function booted()
    {
        static::addGlobalScope(new TeacherScope);
    }



    public function courses()
    {
        return $this->hasMany(Course::class , 'teacher_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }



    public function scopeSuggested($query) {
        
        $query->where('show_in_suggested_in_app', 1);
    }


}
