<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\CourseUnit;
class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::select('id')->get();

        $course_units = [
            ['unit 1'   , 'الوحده الاولى' ] , 
            ['unit 2'   , 'الوحده الثانيه' ] , 
            ['unit 3'   , 'الوحده الثالثه' ] , 
        ];


        foreach ($courses as $course) {
            
            for ($i=0; $i <count($course_units) ; $i++) { 
                $new_course_unit = new CourseUnit;
                $new_course_unit->user_id = 1;
                $new_course_unit->setTranslation('title' , 'en' , $course_units[$i][0] )
                ->setTranslation('title' , 'ar' , $course_units[$i][1] );
                $new_course_unit->course_id = $course->id;
                $new_course_unit->is_active = 1;
                $new_course_unit->save();
            }

        }
    }
}
