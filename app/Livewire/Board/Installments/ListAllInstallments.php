<?php

namespace App\Livewire\Board\Installments;

use Livewire\Component;
use App\Models\{StudentInstallment , StudentPayment   };
use Livewire\Attributes\On; 
use Auth;
class ListAllInstallments extends Component
{   



    #[On('pay')]
    public function payThisInstallment($installment_id)
    {
        $installment = StudentInstallment::find($installment_id);
        if ($installment) {
            $payment = new StudentPayment;
            $payment->student_id = $installment->student_id;
            $payment->user_id = Auth::id();    
            $payment->course_id = $installment->course_id;
            $payment->amount = $installment->amount;
            $payment->type = 2 ;// paying installment
            $payment->save();

            $installment->is_paid = 1;
            $installment->change_to_paid_by = Auth::id();
            $installment->student_payment_id = $payment->id;
            $installment->save();
        } 

       
    }
    

    public function render()
    {
        $installments = StudentInstallment::with('student'  , 'user' , 'course' , 'ChangeToPaidBy' )->latest()->paginate(20);
        return view('livewire.board.installments.list-all-installments' , compact('installments') );
    }
}
