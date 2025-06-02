<?php

namespace App\Livewire\Board\MissingPayments;

use Livewire\Component;
use App\Models\{MissingPayment};
use Livewire\Attributes\On; 
use Auth;
class ListAllMissingPayments extends Component
{   



    

    public function render()
    {
        $missing_payments = MissingPayment::with('student'  , 'user' , 'course')->latest()->paginate(20);
        return view('livewire.board.missing-payments.list-all-missing-payments' , compact('missing_payments') );
    }
}
