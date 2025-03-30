<?php 
use App\Models\{Teacher, Setting , Course};


if (! function_exists('get_default_course_options')) {
    function get_default_course_options($course_id)
    {
        $course = Course::find($course_id);

        if (!$course) {
            return [
                'force_face_detecting' => 0  , 
                'speak_user_phone' => 0  , 
                'show_phone_on_viedo' =>  0 , 
                'force_headphones' => 0  , 
            ];
        }

        return [
            'force_face_detecting' => $course->force_face_detecting  , 
            'speak_user_phone' => $course->speak_user_phone  , 
            'show_phone_on_viedo' =>  $course->show_phone_on_viedo , 
            'force_headphones' => $course->force_headphones  , 
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


