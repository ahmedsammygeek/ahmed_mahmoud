<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseTrashController extends Controller
{
    

    public function index()
    {
        return view('board.trash.courses');
    }
}