<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Question , QuestionAnswer};
class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $questions = Question::get();


        foreach ($questions as $question) {

            for ($i=0; $i <=3 ; $i++) { 

                $question_answer = new QuestionAnswer;
                $question_answer->user_id = 1;
                $question_answer->question_id = $question->id;
                $question_answer->setTranslation('content' , 'ar' , 'الاجابه رقم '.$i );
                $question_answer->setTranslation('content' , 'en' , 'answer number '.$i );
                $question_answer->is_correct_answer = 1;
                $question_answer->save();
            }        
        }


    }
}
