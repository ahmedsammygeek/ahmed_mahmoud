<?php

namespace App\Livewire\Board\Library;

use Livewire\Component;
use App\Models\{Course , Unit , Lesson , Student , LessonVideo , Teacher};
use Livewire\Attributes\Computed;
class AddNewFile extends Component
{


    public $teacher_id;
    public $course_id;
    public $unit_id;
    public $lesson_id;
    public $video_id;


    #[Computed]
    public function teachers()
    {
        return Teacher::select('name' , 'id')->get();
    }


    #[Computed]
    public function courses()
    {
        return Course::select('title' , 'id' , 'teacher_id')
        ->where('teacher_id' , $this->teacher_id )
        ->get();
    }


    #[Computed]
    public function units()
    {
        return Unit::select('title' , 'id', 'course_id')->where('course_id' , $this->course_id)->get();
    }

    #[Computed]
    public function lessons()
    {
        return Lesson::select('title' , 'id', 'unit_id')->where('unit_id' , $this->unit_id)->get();
    }


    #[Computed]
    public function videos()
    {
        return LessonVideo::select('title' , 'id', 'lesson_id')->where('lesson_id' , $this->lesson_id)->get();
    }


    #[Computed]
    public function students()
    {
        return Student::whereHas('courses' , function($query){
            $query->where('course_id' , $this->course_id );
        })
        ->whereHas('units' , function($query){
            $query->where('unit_id' , $this->unit_id );
        })
        ->get();
    }


    public function render()
    {
        return view('livewire.board.library.add-new-file');
    }
}
