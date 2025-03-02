<?php

namespace App\Livewire\Board\Videos;

use Livewire\Component;
use App\Models\{Course , Unit , Lesson , Student , LessonVideo};
use Livewire\Attributes\Computed;
class AddNewVideo extends Component
{


    public $courses;
    public $course_id;
    public $unit_id;
    public $lesson_id;


    public function mount()
    {
        $this->courses = Course::select('id' , 'title' )->get();
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



    public function render()
    {
        return view('livewire.board.videos.add-new-video');
    }
}
