<?php

namespace App\Livewire\Board\Courses;

use Livewire\Component;
use App\Models\{Unit , StudentUnit};
class RemoveStudentsFromCourse extends Component
{
    public $course;
    public $unit_id = [];



    public function removeAllStudents()
    {
        StudentUnit::whereIn('unit_id' , $this->unit_id )->delete();

        $this->dispatch('studentDeletedFromCourse');
    }



    public function render()
    {
        $units = Unit::where('course_id' , $this->course->id )->get();
        return view('livewire.board.courses.remove-students-from-course' , compact('units'));
    }
}
