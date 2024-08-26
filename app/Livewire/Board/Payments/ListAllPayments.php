<?php

namespace App\Livewire\Board\Payments;

use Livewire\Component;
use App\Models\{StudentPayment   };
use Livewire\Attributes\On; 
use Auth;
class ListAllPayments extends Component
{   
    public function render()
    {
        $payments = StudentPayment::with('student'  , 'user' , 'course'  )->latest()->paginate(20);
        return view('livewire.board.payments.list-all-payments' , compact('payments') );
    }
}
