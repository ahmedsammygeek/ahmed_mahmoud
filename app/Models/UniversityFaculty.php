<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityFaculty extends Model
{
    use HasFactory;

    protected $fillable = ['university_id' , 'faculty_id' , 'user_id' , 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function university()
    {
        return $this->belongsTo(University::class);
    }



    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

}
