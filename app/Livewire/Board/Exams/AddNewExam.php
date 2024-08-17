<?php

namespace App\Livewire\Board\Exams;

use Livewire\Component;
use App\Models\{Course , Question , Lesson };

use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 

use Carbon\Carbon;
class AddNewExam extends Component
{

    public $course_id;
    public $lesson_id;
    public $selected_qestions = [];
    public $can_user_re_exam = 0;
    public $type;
    public $questions_choosing_type = 1 ;


    #[Computed]
    public function questions()
    {
        if ($this->lesson_id) {
            return Question::where('course_id' , $this->course_id )->where('lesson_id' , $this->lesson_id )->get();
        }
        return Question::where('course_id' , $this->course_id )->get();
    }


    public function mount()
    {
        $this->date = Carbon::now();
    }

    #[Computed]
    public function lessons()
    {
        return Lesson::whereHas('unit' , function($query){
            $query->where('course_id' , $this->course_id );
        })->get();
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
