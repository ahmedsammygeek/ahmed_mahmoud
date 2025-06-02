<?php

namespace App\Livewire\Board\Videos;

use Livewire\Component;

class SortVideoByInput extends Component
{

    protected $listeners = ['itemUpdated' => '$refresh' ];  

    public $video;
    public $video_sort;

    public function mount()
    {
        $this->video_sort = $this->video->sorting;
    }

    // public function updatingVideoSortProperty()
    // {
    //     $this->video->sorting = $this->video_sort;
    //     $this->video->save();
    // }


    public function render()
    {
        return view('livewire.board.videos.sort-video-by-input');
    }
}
