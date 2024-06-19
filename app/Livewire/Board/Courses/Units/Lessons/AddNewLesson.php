<?php

namespace App\Livewire\Board\Courses\Units\Lessons;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
class AddNewLesson extends Component
{   
    use WithFileUploads;
    public $unit;
    public $course;
    public $video_type;

    public $video;


    public function updatedVideoType()
    {
       if ($this->video_type == 'upload' ) {
           $this->dispatch('prepareFilePondPlugin');
       }
    }

    public function save()
    {
        $this->video->store(path: 'temp_videos' , disk : 'public');
    }

    public function render()
    {
        // dd($this->course , $this->unit );
        return view('livewire.board.courses.units.lessons.add-new-lesson');
    }
}
