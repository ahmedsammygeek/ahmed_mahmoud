<?php

namespace App\Livewire\Board\Students\Courses;

use Livewire\Component;
use Livewire\Attributes\On; 
class AddCoursesToStudent extends Component
{

    public $courses_count = 1;
    public $student;

    #[On('decreaseCoursesCountEvent')] 
    public function updateCoursesCount()
    {
         $this->courses_count = $this->courses_count - 1;
    }

    public function addMoreCoursesToThisStudents()
    {
        $this->courses_count = $this->courses_count + 1;
    }


    public function render()
    {
        return view('livewire.board.students.courses.add-courses-to-student');
    }
}
