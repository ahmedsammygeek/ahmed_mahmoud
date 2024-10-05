<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class University extends Model
{
    use HasFactory , HasTranslations;

    public $translatable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function faculties()
    {
        return $this->hasMany(UniversityFaculty::class);
    }


}
