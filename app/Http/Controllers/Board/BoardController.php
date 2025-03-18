<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Student , User , Course  , Group , Exam , StudentInstallment };
use Carbon\Carbon;
class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students_count = Student::count();
        $admins_count = User::where('type'  , 1)->count();
        $teachers_count = User::where('type'  , 2)->count();
        $courses_count = Course::count();
        $groups_count = Course::count();
        $exams_count = Course::count();
        $due_date_installments_count = StudentInstallment::where('is_paid'  , 0 )
        ->whereDate('due_date' , '<=' , Carbon::today() )
        ->count();

        return view('board.index' , compact('students_count', 'admins_count' , 'teachers_count' , 'courses_count'  , 'groups_count' , 'exams_count' , 'due_date_installments_count' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
