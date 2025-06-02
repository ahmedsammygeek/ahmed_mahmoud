<?php

namespace App\Livewire\Board\Videos;

use Livewire\Component;
use App\Models\{LessonVideo };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
class ListAllLessonVideos extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;
    public $lesson;
    public $search;


    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh'  , 'itemUpdated' => '$refresh' ];  


    public function updated()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        $item = LessonVideo::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function updateVideoOrder($items)
    {
        foreach ($items as $item) {
            $video = LessonVideo::find($item['value']);
            if ($video) {
                $video->sorting = $item['order'];
                $video->save();
            }
        }

        $this->dispatch('itemUpdated');
    }




    public function render()
    {
        $videos = LessonVideo::query()
        ->with(['lesson' , 'user' ])
        ->when($this->search , function($query){
            $query
            ->where('title' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('title' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        ->where('lesson_id' , $this->lesson->id )
        ->orderBy('sorting' , 'ASC' )
        ->paginate($this->rows);

        return view('livewire.board.videos.list-all-lesson-videos' , compact('videos') );
    }
}
