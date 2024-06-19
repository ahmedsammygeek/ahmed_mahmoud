<?php

namespace App\Actions\Board\StudentActions;
use Illuminate\Http\Request;
use App\Models\Student;
use Auth;
class StoreStudentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    public function execute(Request $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->password = $request->password;
        $student->grade_id = $request->grade;
        $student->educational_system_id = $request->educational_system_id;
        $student->mobile = $request->mobile;
        $student->guardian_mobile = $request->guardian_mobile;
        $student->is_banned = $request->filled('is_active') ? 0 : 1;
        $student->user_id = Auth::id();
        $student->save();
        return $student;
    }
}
