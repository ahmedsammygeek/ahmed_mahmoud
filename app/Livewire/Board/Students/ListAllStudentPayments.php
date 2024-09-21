<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\StudentPayment;
use Livewire\Attributes\On;
class ListAllStudentPayments extends Component
{

    public $student;    


    #[On('delete-payment')] 
    public function deleteStudentPayment($item_id)
    {
        $item = StudentPayment::find($item_id);
        if ($item) {
            $item->delete();
            $this->dispatch('paymentDeleted');
        }
    }


    public function render()
    {
        $payments = StudentPayment::with(['user', 'user'  , 'course' ])->where('student_id' , $this->student->id )->latest()->get();
        return view('livewire.board.students.list-all-student-payments'  , compact('payments') );
    }
}
