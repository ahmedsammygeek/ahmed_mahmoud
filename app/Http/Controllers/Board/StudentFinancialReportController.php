<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Student , StudentPayment , StudentInstallment };
class StudentFinancialReportController extends Controller
{
    

    public function index(Student $student)
    {
        $installments = StudentInstallment::where('student_id' , $student->id )->latest()->get();
        $payments = StudentPayment::where('student_id' , $student->id )->latest()->get();
        return view('board.students.financial_reports' , compact('student' , 'installments' , 'payments' ) );
    }
}
