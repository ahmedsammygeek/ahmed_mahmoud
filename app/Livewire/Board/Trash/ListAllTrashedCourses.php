<?php

namespace App\Livewire\Board\Trash;

use Livewire\Component;
use App\Models\{Course };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
class ListAllTrashedCourses extends Component
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
        $item = Course::withTrashed()->find($itemId);
        if($item) {
            $item->forceDelete();
            $this->dispatch('itemDeleted');
        }
    }

    public function restoreItem($itemId)
    {
        $item = Course::withTrashed()->find($itemId);
        if($item) {
            $item->restore();
            $item->deleted_by = null;
            $item->save();
            $this->dispatch('itemRestored');
        }
    }


    public function render()
    {
        $courses = Course::query()
        ->onlyTrashed()
        ->when($this->search , function($query){
            $query
            ->where('title->ar' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('title->en' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.trash.list-all-trashed-courses' , compact('courses') );
    }
}
