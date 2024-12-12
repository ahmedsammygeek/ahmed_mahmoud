<?php

namespace App\Livewire\Board\Trash;

use Livewire\Component;
use App\Models\{Student , Grade , EducationalSystem , Course , Teacher };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
class ListAllTrashedStudents extends Component
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
        $item = Student::withTrashed()->find($itemId);
        if($item) {
            $item->forceDelete();
            $this->dispatch('itemDeleted');
        }
    }

    public function restoreItem($itemId)
    {
        $item = Student::withTrashed()->find($itemId);
        if($item) {
            $item->restore();
            $item->deleted_by = null;
            $item->save();
            $this->dispatch('itemRestored');
        }
    }


    public function render()
    {
        $students = Student::query()
        ->onlyTrashed()
        ->with(['grade' , 'educationalSystem' ])
        ->when($this->search , function($query){
            $query
            ->where('name' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('mobile' ,  'LIKE' , '%'.$this->search.'%'  )
            ->orWhere('guardian_mobile' ,  'LIKE' , '%'.$this->search.'%' );
        })
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.trash.list-all-trashed-students' , compact('students') );
    }
}
