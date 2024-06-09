<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;
class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $Grades = [
            ['Grade 1' , ' الصف الاول '] , 
            ['Grade 2' , ' الصف الثانى '] , 
            ['Grade 3' , ' الصف الثالث '] , 
            ['Grade 4' , ' الصف الرابع '] , 
        ];


        for ($i=0; $i <count($Grades) ; $i++) { 
            
            $Grade = new Grade;
            $Grade->setTranslation('name', 'ar' , $Grades[$i][1] )
            ->setTranslation('name' , 'en' , $Grades[$i][0] );
            $Grade->user_id = 1;
            $Grade->is_active = 1;
            $Grade->save();
        }

    }
}
