<?php

namespace App\Livewire\Board\Questions;

use Livewire\Component;
use App\Models\{Course};
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 
use Livewire\WithFileUploads;
use App\Models\Question;

use Auth;
class AddNewQuestion extends Component
{
    use WithFileUploads;




    #[Validate('required')] 
    public $question_type;

    #[Validate('required')] 
    public $answer_type;

    #[Validate('required')] 
    public $course_id;

    #[Validate('required')] 
    public $degree;


    #[Validate('required_if:question_type,1')] 
    public $question_text_content_ar;

    #[Validate('required_if:question_type,1')] 
    public $question_text_content_en;

    #[Validate('required_if:question_type,2')] 
    public $question_image_content;


    #[Validate('required_if:answer_type,1')] 
    public $correct_answer;

    #[Validate('required_if:answer_type,1|array|size:4')] 
    public $answers_ar = [] ;

    #[Validate('required_if:answer_type,1|array|size:4')] 
    public $answers_en = [] ;

    
    public function addQuestion()
    {
        // code...
    }


    public function save()
    {
        $this->validate();

        dd($this->answers_ar , $this->answers_en );

        $question = new Question;
        $question->course_id = $this->course_id;
        $question->user_id = Auth::id();
        $question->type = $this->question_type;
        $question->answer_type = $this->answer_type;
        $question->degree = $this->degree;
        $question->is_active = 1;
        if ($this->question_type == 1 ) {
            $question->content = $this->question_text_content;
            // $question->content = $this->question_text_content;
        } else {
            $image = $this->question_image_content->store('questions');
            $question->setTranslation('content' , 'en' , $image );
            $question->setTranslation('content' , 'ar' , $image );
        }
        $question->save();


        // dd($this->answers , $this->correct_answer ); 

        dd('ff');
    }



    public function render()
    {
        $courses = Course::select('id' , 'title' )->get();
        return view('livewire.board.questions.add-new-question' , compact('courses') );
    }
}
