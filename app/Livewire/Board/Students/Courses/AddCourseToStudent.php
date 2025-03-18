<?php

namespace App\Livewire\Board\Students\Courses;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\{Course , Teacher};
class AddCourseToStudent extends Component
{
    public $student;
    public $course_id;
    public $teacher_id;

    #[Computed]
    public function teachers()
    {
        return Teacher::select('name' , 'id' )->get();
    }

    #[Computed]
    public function courses()
    {
        return Course::select('title' , 'id' , 'teacher_id' )
        ->where('teacher_id' , $this->teacher_id )
        ->get();
    }


    public function updated( $property ,  $value)
    {
       // dd($property , $value)
    }


    public function render()
    {
        return view('livewire.board.students.courses.add-course-to-student');
    }
}
