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
        $student->banning_message = $data['banning_message'];
        $student->is_banned = array_key_exists('is_banned', $data) ? 1 : 0;
        $student->save();

        if (array_key_exists('is_banned', $data) && $data['is_banned'] == 1 ) {
            $student->mobile_serial_number = null;
            $student->unique_device_id = null;
            $student->save();
            $student->tokens()->delete();
            $student->tokens()->delete();
        }

        return $student;
    }
}
