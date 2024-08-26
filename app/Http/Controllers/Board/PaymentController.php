<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentPayment;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.payments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentPayment $payment)
    {
        $payment->load('course' , 'user' , 'student' );
        return view('board.payments.show' , compact('payment') );
    }


}
