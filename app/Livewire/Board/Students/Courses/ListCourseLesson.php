<?php

namespace App\Livewire\Board\Students\Courses;

use Livewire\Component;

class ListCourseLesson extends Component
{
    public $lesson;
    public $index;
    public $allowed_views;
    public $remains_views;



    public function updatedAllowedViews()
    {
        $this->lesson->allowed_views = $this->allowed_views;
        $this->lesson->remains_views = $this->allowed_views;
        $this->lesson->save();
        $this->remains_views = $this->allowed_views ;
    }


    public function updatedRemainsViews()
    {
        $this->lesson->remains_views = $this->remains_views;
        $this->lesson->save();
        $refesh;
    }


    public function mount()
    {
        $this->allowed_views = $this->lesson->allowed_views;
        $this->remains_views = $this->lesson->remains_views;
    }


    public function disallow()
    {
        $this->lesson->allowed = 0;
        $this->lesson->save();
    }

    public function allow()
    {
        $this->lesson->allowed = 1;
        $this->lesson->save();
    }

    public function render()
    {
        return view('livewire.board.students.courses.list-course-lesson');
    }
}
