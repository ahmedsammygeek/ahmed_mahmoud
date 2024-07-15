<?php

namespace App\Livewire\Board\Grades;

use Livewire\Component;
use App\Models\Grade;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllGrades extends Component
{

    use WithPagination , WithoutUrlPagination ;
    protected $paginationTheme = 'bootstrap';
    public $rows;
    public $is_active = 'all';

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    public function updatedRows()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        $item = Grade::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $grades = Grade::query()

        ->latest()->paginate($this->rows);

        return view('livewire.board.grades.list-all-grades' , compact('grades') );
    }
}
