<?php

namespace App\Livewire\Board\Students\Library;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\{Course , Teacher , Unit , Group , LessonFile , Lesson};
class AddCourseToStudent extends Component
{
    public $student;
    public $course_id;
    public $teacher_id;
    public $units_id = [] ;
    public $lessons_id = [];
    public $files_id = [];
    public $selectAll = false;




    public function selectAllLessons() {

        $this->selectAll = !$this->selectAll;
        if ($this->selectAll) {
            $this->files_id =  $this->files()->pluck('id')->toArray()  ;
        } else {
            $this->files_id =  []  ;
        }
    }



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

    #[Computed]
    public function units()
    {
        return Unit::select('title' , 'id' , 'course_id' )
        ->where('course_id' , $this->course_id )
        ->get();
    }


    #[Computed]
    public function groups()
    {
        return Group::select('name' , 'id' , 'course_id' )
        ->where('course_id' , $this->course_id )
        ->get();
    }

    #[Computed]
    public function lessons()
    {
        return Lesson::select('title' , 'id'  )
        ->whereIn('unit_id' , $this->units_id )
        ->get();
    }

    #[Computed]
    public function files()
    {
        return LessonFile::select('name' , 'id'  )
        ->whereIn('lesson_id' , $this->lessons_id )
        ->get();
    }




    public function updated( $property ,  $value)
    {
       // dd($property , $value);
    }


    public function render()
    {
        return view('livewire.board.students.library.add-course-to-student');
    }
}
