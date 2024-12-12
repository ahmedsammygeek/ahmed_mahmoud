<?php

namespace App\Livewire\Board\Videos;

use Livewire\Component;
use App\Models\{Course , Unit , Lesson , LessonVideo};
use Livewire\Attributes\Computed;
class EditVideo extends Component
{


    public $courses;
    public $course_id;
    public $unit_id;
    public $lesson_id;
    public $video;


    public function mount()
    {
        $this->courses = Course::select('id' , 'title' )->get();
        $this->course_id = $this->video->lesson?->unit?->course_id;
        $this->unit_id = $this->video->lesson?->unit_id;
        $this->lesson_id = $this->video->lesson_id;
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
        return view('livewire.board.videos.edit-video');
    }
}
