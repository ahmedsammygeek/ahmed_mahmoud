<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;
class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Faculty = new Faculty;
        $Faculty->setTranslation('name' , 'ar' , 'طب' );
        $Faculty->setTranslation('name' , 'en' , 'medicine' );
        $Faculty->user_id = 1;
        $Faculty->is_active = 1;
        $Faculty->save();

        $Faculty = new Faculty;
        $Faculty->setTranslation('name' , 'ar' , 'طب اسنان' );
        $Faculty->setTranslation('name' , 'en' , 'Dentistry' );
        $Faculty->user_id = 1;
        $Faculty->is_active = 1;
        $Faculty->save();


        $Faculty = new Faculty;
        $Faculty->setTranslation('name' , 'ar' , 'تجاره' );
        $Faculty->setTranslation('name' , 'en' , 'commerce' );
        $Faculty->user_id = 1;
        $Faculty->is_active = 1;
        $Faculty->save();

        $Faculty = new Faculty;
        $Faculty->setTranslation('name' , 'ar' , 'حقوق' );
        $Faculty->setTranslation('name' , 'en' , ' Law' );
        $Faculty->user_id = 1;
        $Faculty->is_active = 1;
        $Faculty->save();


        $Faculty = new Faculty;
        $Faculty->setTranslation('name' , 'ar' , 'هندسه' );
        $Faculty->setTranslation('name' , 'en' , 'Engineering' );
        $Faculty->user_id = 1;
        $Faculty->is_active = 1;
        $Faculty->save();

        $Faculty = new Faculty;
        $Faculty->setTranslation('name' , 'ar' , 'حاسبات و معلومات' );
        $Faculty->setTranslation('name' , 'en' , 'computer and information' );
        $Faculty->user_id = 1;
        $Faculty->is_active = 1;
        $Faculty->save();
    }
}
