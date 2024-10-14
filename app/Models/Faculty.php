<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Faculty extends Model
{
    use HasFactory , HasTranslations;
    public $translatable = ['name'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function levels()
    {
        return $this->hasMany(FacultyLevel::class);
    }
    
}
