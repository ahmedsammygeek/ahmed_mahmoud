<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Student , Course  };
class StudentUnitcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Student $student , Course $course)
    {
        return view('board.students.units.index' , compact('student' , 'course' ) );
    }




    public function assgin_students_to_units()
    {
        return view('board.students.assgin_students_to_units');
    }

}
