<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseUnitLesson;
use App\Models\CourseUnit;
use Illuminate\Support\Arr;
class UnitLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = CourseUnit::select('id')->get();

        $videos = [
            'https://www.youtube.com/watch?v=VqvNjPEsfos' , 
            'https://www.youtube.com/watch?v=3RbV94vnokg' , 
            'https://www.youtube.com/watch?v=Fk4sDmRFpl4' , 
            'https://www.youtube.com/watch?v=AVYfyTvc9KY' , 
            'https://www.youtube.com/watch?v=le_drhF4YeI' , 
            'https://www.youtube.com/watch?v=1JephUxTHxg' , 
            'https://www.youtube.com/watch?v=NapGLT3WFX8' , 
            'https://www.youtube.com/watch?v=FWI9GEwJNzc' , 
            'https://www.youtube.com/watch?v=QoKpQMJnBHY' , 
            'https://www.youtube.com/watch?v=kFvFJ5JzOnU' , 
            'https://www.youtube.com/watch?v=XHXoJNaXyls' , 
            'https://www.youtube.com/watch?v=LwmMLfre58k' , 
            'https://www.youtube.com/watch?v=VXZPsZLNeSE' , 
        ];


        $title = [
            'الدرس رقم ' , 
            'lesson number '
        ];

        $content = [
            'محتوى الدرس الدرس رقم  و سوف يتم شرح الجزء الاتى ' , 
            'lesson number and we will learn how to do this '
        ];  


        foreach ($units as $unit) {
            
            for ($i=0; $i < 3 ; $i++) { 
                $new_lesson = new CourseUnitLesson;
                $new_lesson->user_id = 1;
                $new_lesson->is_active = 1;
                $new_lesson->course_unit_id = $unit->id;
                $new_lesson
                ->setTranslation('title' , 'ar' ,  $title[0] )
                ->setTranslation('title' , 'en' , $title[1] );
                $new_lesson
                ->setTranslation('content' , 'ar' ,  $content[0] )
                ->setTranslation('content' , 'en' , $content[1] );
                $new_lesson->is_free = mt_rand(0 , 1);
                $new_lesson->allowed_views = 10;
                $new_lesson->lesson_mins = mt_rand(1 , 12);
                $new_lesson->lesson_video_link = Arr::random($videos);
                $new_lesson->lesson_video_driver = 'youtube';
                $new_lesson->save();
            }
        }
    }
}
