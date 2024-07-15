<?php

namespace App\Livewire\Board\Exams;

use Livewire\Component;
use Auth;
class StudentExamAnswer extends Component
{


    public $student_exam_answer;
    public $index;
    public $degree;
    public $correct_answer_content;


    public function markAsFalse()
    {
        $this->student_exam_answer->degree = 0;
        $this->student_exam_answer->is_marked = true;
        $this->student_exam_answer->marked_by = Auth::id();
        $this->student_exam_answer->save();
        $refresh;
    }

    public function markAsTrue()
    {
        $this->student_exam_answer->degree = $this->student_exam_answer->question?->degree ;
        $this->student_exam_answer->is_marked = true;
        $this->student_exam_answer->marked_by = Auth::id();
        $this->student_exam_answer->save();
        $refresh;
    }

    public function render()
    {
        return view('livewire.board.exams.student-exam-answer');
    }
}
