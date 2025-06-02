<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissingPayment extends Model
{
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
