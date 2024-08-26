<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\StudentPayment;
class ListAllStudentPayments extends Component
{

    public $student;


    public function render()
    {
        $payments = StudentPayment::with(['user', 'user'  , 'course' ])->where('student_id' , $this->student->id )->latest()->get();
        return view('livewire.board.students.list-all-student-payments'  , compact('payments') );
    }
}
