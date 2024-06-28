<?php

namespace App\Actions\Board\StudentActions;

class UpdateStudentAction
{
 



    public function execute($data , $student )
    {

        $student->name = $data['name'];
        $student->grade_id = $data['grade'];
        $student->educational_system_id = $data['educational_system_id'];
        $student->mobile = $data['mobile'];
        $student->guardian_mobile = $data['guardian_mobile'];
        $student->student_type = $data['student_type'];
        $student->save();
        return $student;
    }
}
