<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Student , Course , MissingPayment };
use Auth;
class StudentMissingPaymentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Student $student)
    {
        $courses = Course::select('id' , 'title')->get();
        return view('board.missing_payments.create' , compact('student' , 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Student $student)
    {

        $missing_payment = new MissingPayment;
        $missing_payment->user_id = Auth::id();
        $missing_payment->course_id = $request->course_id;
        $missing_payment->student_id = $student->id;
        $missing_payment->paid_amount = $request->paid_amount;
        $missing_payment->remains_amount = $request->remains_amount;
        $missing_payment->notes = $request->notes;
        $missing_payment->save();
        return redirect(route('board.missing_payments.index'))->with('success' , 'تم الاضافه بنجاح');
    }
}
