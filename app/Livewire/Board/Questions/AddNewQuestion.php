<?php

namespace App\Livewire\Board\Questions;

use Livewire\Component;
use App\Models\{Course};
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 
use Livewire\WithFileUploads;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Lesson;
class AddNewQuestion extends Component
{
    use WithFileUploads , LivewireAlert ;

    public $question_type;
    public $answer_type;
    public $course_id;
    public $lesson_id;
    public $degree;

    public $question_text_content_ar;
    public $question_text_content_en;
    public $question_image_content;
    public $correct_answer;
    public $answers_ar = [] ;
    public $answers_en = [] ;

    #[Computed]
    public function lessons()
    {
        return Lesson::whereHas('unit' , function($query){
            $query->where('course_id' , $this->course_id );
        })->get();
    }



    public function save()
    {

        $rules = [
            'course_id' => 'required',
            'degree' => 'required',
            'answer_type' => 'required' , 
            'question_type' => 'required' , 
            'lesson_id' => 'nullable' , 
            'question_text_content_ar' => 'required_if:question_type,1' , 
            'question_text_content_en' => 'required_if:question_type,1' , 
            'question_image_content' => 'required_if:question_type,2' , 
            'correct_answer' => 'required_if:answer_type,1' , 
        ];

        if ($this->answer_type == 1 ) {
            $rules['answers_ar'] = 'array|size:4|required_if:answer_type,1' ; 
            $rules['answers_en'] = 'array|size:4|required_if:answer_type,1' ; 
        }

        $this->validate($rules);


        $question = new Question;
        $question->course_id = $this->course_id;
        $question->user_id = Auth::id();
        $question->type = $this->question_type;
        $question->answer_type = $this->answer_type;
        $question->degree = $this->degree;
        $question->lesson_id = $this->lesson_id;
        $question->is_active = 1;
        if ($this->question_type == 1 ) {
            $question->setTranslation('content' , 'en' , $this->question_text_content_ar );
            $question->setTranslation('content' , 'ar' , $this->question_text_content_en );
        } else {
            $image = basename($this->question_image_content->store('questions'));
            $question->setTranslation('content' , 'en' , $image );
            $question->setTranslation('content' , 'ar' , $image );
        }
        $question->save();

        if ($this->answer_type == 2 ) {
            $answers = [];

            for ($i=0; $i <count($this->answers_ar) ; $i++) { 
                $content = [
                    'ar' => $this->answers_ar[$i] , 
                    'en' => $this->answers_ar[$i] , 
                ];
                $answers[] = new  QuestionAnswer([
                    'question_id' => $question->id , 
                    'user_id' => Auth::id(), 
                    'content' => $content , 
                    'is_correct_answer' => $this->correct_answer == $i ? 1 : 0 , 
                ]);
            }

            $question->answers()->saveMany($answers);
        }       


        $this->alert('success', trans('questions.question added successfully ') , [
            'toast' => false , 
            'position' => 'center' , 
        ]);

        $this->reset();
    }



    public function render()
    {
        $courses = Course::select('id' , 'title' )->get();
        return view('livewire.board.questions.add-new-question' , compact('courses') );
    }
}
