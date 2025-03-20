<?php

namespace App\Livewire\Board\Students\Library;

use Livewire\Component;

class ListAllCourses extends Component
{
    public $student;
    
    public function render()
    {
        return view('livewire.board.students.library.list-all-courses');
    }
}
