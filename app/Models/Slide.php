<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeActive($query) {
        
        $query->where('is_active', 1);
    }
}
