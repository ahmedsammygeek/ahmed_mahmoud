<?php

namespace App\Livewire\Board\Trash;

use Livewire\Component;
use App\Models\{ Lesson };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
class ListAllTrashedLessons extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;
    public $student_type;
    public $search;
    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh'  ,  'itemRestored' => '$refresh' , 'restoreItem' ];  


    public function updated()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        $item = Lesson::withTrashed()->find($itemId);
        if($item) {
            $item->forceDelete();
            $this->dispatch('itemDeleted');
        }
    }

    public function restoreItem($itemId)
    {
        $item = Lesson::withTrashed()->find($itemId);
        if($item) {
            $item->restore();
            $item->deleted_by = null;
            $item->save();
            $this->dispatch('itemRestored');
        }
    }


    public function render()
    {
        $lessons = Lesson::query()
        ->onlyTrashed()
        ->when($this->search , function($query){
            $query
            ->where('title->ar' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('title->en' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.trash.list-all-trashed-lessons' , compact('lessons') );
    }
}
