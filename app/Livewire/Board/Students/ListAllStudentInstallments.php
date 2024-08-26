<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\StudentInstallment;
class ListAllStudentInstallments extends Component
{

    public $student;


    public function render()
    {
        $installments = StudentInstallment::with(['user', 'ChangeToPaidBy'  , 'course' ])->where('student_id' , $this->student->id )->latest()->get();
        return view('livewire.board.students.list-all-student-installments'  , compact('installments') );
    }
}
