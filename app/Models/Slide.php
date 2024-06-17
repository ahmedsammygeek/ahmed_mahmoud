<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Slide extends Model
{
    use HasFactory , HasTranslations ;

    public $translatable = ['title' , 'subtitle'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeActive($query) {
        
        $query->where('is_active', 1);
    }
}
