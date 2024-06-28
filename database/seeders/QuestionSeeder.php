<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        for ($i=0; $i < 200 ; $i++) { 
            $Question = new Question;
            $Question->setTranslation( 'content' ,  'en'  , 'Question number '.$i );
            $Question->setTranslation( 'content' ,  'ar'  , 'السؤال رقم '.$i );
            $Question->is_active = 1;
            $Question->user_id = 1;
            $Question->type = 1;
            $Question->use_it_again = 1;
            $Question->degree = mt_rand(1 , 5);
            $Question->course_id = mt_rand(1 , 11);
            $Question->save();
        }
    }
}
