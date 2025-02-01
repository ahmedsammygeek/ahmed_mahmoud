<?php

namespace App\Livewire\Board\Library;

use Livewire\Component;
use App\Models\{Course , Unit , Lesson , LessonVideo};
use Livewire\Attributes\Computed;
class AddNewFile extends Component
{


    public $course_id;
    public $unit_id;
    public $lesson_id;


    #[Computed]
    public function courses()
    {
        return Course::select('title' , 'id')->get();
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


    public function render()
    {
        return view('livewire.board.library.add-new-file');
    }
}
