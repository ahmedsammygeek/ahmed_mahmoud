<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class DashboardNotification extends Model
{
    use HasFactory , HasTranslations;

    public $translatable = ['title' , 'content' ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
