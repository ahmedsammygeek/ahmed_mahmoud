<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInstallment extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id');
    }
    public function ChangeToPaidBy()
    {
        return $this->belongsTo(User::class , 'change_to_paid_by');
    }

    public function payment()
    {
        return $this->hasOne(StudentPayment::clas , 'student_payment_id');
    }

}
