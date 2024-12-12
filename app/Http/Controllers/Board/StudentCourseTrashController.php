<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentCourseTrashController extends Controller
{
    

    public function index()
    {
        return view('board.trash.students_courses');
    }
}
