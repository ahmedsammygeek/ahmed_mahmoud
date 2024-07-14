<?php

namespace App\Livewire\Board\Exams;

use Livewire\Component;
use App\Models\{Course , Question };

use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 
class AddNewExam extends Component
{

    public $course_id;
    public $selected_qestions = [];
    public $can_user_re_exam = 0;


    #[Computed]
    public function questions()
    {
        return Question::where('course_id' , $this->course_id )->get();
    }

    public function save()
    {
        $groups = Group::where('course_id' , $this->course_id )->get();

        dd($courses);
        sleep(4);    
    }

    public function render()
    {
        $courses = Course::select('id' , 'title' )->get();
        return view('livewire.board.exams.add-new-exam' , compact('courses') );
    }
}
