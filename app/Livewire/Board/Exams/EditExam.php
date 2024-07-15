<?php

namespace App\Livewire\Board\Exams;

use Livewire\Component;
use App\Models\{Course , Question };

use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 
class EditExam extends Component
{

    public $exam;
    public $course_id;
    public $selected_questions = [];
    public $can_user_re_exam = 0;

    public function mount()
    {
        $this->course_id = $this->exam->course_id;
        $this->can_user_re_exam = (bool)$this->exam->can_user_re_exam;
        $this->selected_questions = $this->exam->questions()->pluck('question_id')->toArray();
    }


    #[Computed]
    public function questions()
    {
        return Question::where('course_id' , $this->course_id )->get();
    }



    public function render()
    {
        $courses = Course::select('id' , 'title' )->get();
        return view('livewire.board.exams.edit-exam' , compact('courses') );
    }
}
