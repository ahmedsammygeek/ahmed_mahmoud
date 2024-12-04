<?php

namespace App\Actions\Board\StudentActions;

use App\Models\Student;
use Auth;
class StoreStudentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    public function execute($data)
    {

        $student = new Student;
        $student->name = $data['name'];
        $student->password = array_key_exists('password' , $data ) ? $data['password'] : null ;
        $student->grade_id = $data['grade'];
        $student->educational_system_id = $data['educational_system_id'];
        $student->mobile = $data['mobile'];
        $student->guardian_mobile = $data['guardian_mobile'];
        $student->is_banned =  0 ;
        $student->student_type = $data['student_type'];
        $student->user_id = Auth::id();
        $student->code = time().mt_rand(100 ,  1000);
        $student->is_banned = array_key_exists('is_banned', $data) ? 1 : 0;
        $student->save();
        return $student;
    }
}
