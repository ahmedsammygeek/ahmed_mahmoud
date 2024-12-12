<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonTrashController extends Controller
{
    
    public function index()
    {
        return view('board.trash.lessons');
    }
}
