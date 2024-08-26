<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\StudentExam;
class ListAllStudentExams extends Component
{

    public $student;


    public function render()
    {
        $exams = StudentExam::with(['student'  , 'exam' , 'markedBy' ])->where('student_id' , $this->student->id )->latest()->get();
        return view('livewire.board.students.list-all-student-exams'  , compact('exams') );
    }
}
