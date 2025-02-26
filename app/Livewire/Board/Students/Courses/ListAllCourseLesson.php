<?php

namespace App\Livewire\Board\Students\Courses;

use Livewire\Component;
use App\Models\StudentLesson;
class ListAllCourseLesson extends Component
{
    public $student;
    public $course;

    public function render()
    {
        $student_lessons = StudentLesson::with(['lesson' , 'user' , 'video' ])->where('student_id' , $this->student->id )->whereIn('lesson_id' , $this->course->lessons()->pluck('lessons.id')->toArray() )->get();


        return view('livewire.board.students.courses.list-all-course-lesson' , compact('student_lessons') );
    }
}
