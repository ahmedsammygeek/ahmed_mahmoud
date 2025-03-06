<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StudentUnit extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['user_id' , 'student_id' , 'unit_id' , 'is_allowed'];


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }


    public function unit()
    {
        return $this->belongsTo(Unit::class , 'unit_id');
    }
}
