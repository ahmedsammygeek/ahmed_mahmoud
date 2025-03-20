<?php 
use App\Models\{Teacher, Setting , Course};

if (! function_exists('get_default_course_options')) {
    function get_default_course_options($course_id)
    {
        $course = Course::find($course_id);
        // $Teacher = Teacher::find()
        if ($course) {
            if ($course->force_face_detecting || $course->speak_user_phone || $course->show_phone_on_viedo || $course->force_headphones ) {

                return [
                    'force_face_detecting' => $course->force_face_detecting , 
                    'speak_user_phone' => $course->speak_user_phone , 
                    'show_phone_on_viedo' =>  $course->show_phone_on_viedo, 
                    'force_headphones' => $course->force_headphones , 
                ];
            } else {

                $teacher = Teacher::where('id' , $course->teacher_id )->first();
                if ($teacher->force_face_detecting || $teacher->speak_user_phone || $teacher->show_phone_on_viedo || $teacher->force_headphones ) {
                    return [
                        'force_face_detecting' => $teacher->force_face_detecting , 
                        'speak_user_phone' => $teacher->speak_user_phone , 
                        'show_phone_on_viedo' =>  $teacher->show_phone_on_viedo, 
                        'force_headphones' => $teacher->force_headphones , 
                    ];
                } else {
                    return [
                        'force_face_detecting' => 1 , 
                        'speak_user_phone' => 1 , 
                        'show_phone_on_viedo' =>  1, 
                        'force_headphones' => 1 , 
                    ];
                }
            }

        }

        return [
            'force_face_detecting' => 1 , 
            'speak_user_phone' => 1 , 
            'show_phone_on_viedo' =>  1, 
            'force_headphones' => 1 , 
        ];
    }
}


if (! function_exists('get_default_course_views')) {
    function get_default_course_views($course_id)
    {
        $course = Course::find($course_id);
        
        if ($course) {
            if ($course->default_view_number) {
                return $course->default_view_number;
            }             
            $teacher = Teacher::where('id' , $course->teacher_id )->first();

            if ($teacher?->default_views_number) {
                return $teacher->default_views_number;
            }  
        } 

        $settings = Setting::first();
        if ($settings->default_views_number) {
            return $settings->default_views_number;
        } 

        return 10;
    }
}


