<?php

namespace App\Livewire\Board\FacultiesLevels;

use Livewire\Component;
use App\Models\FacultyLevel;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllFacultiesLevels extends Component
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
        $item = FacultyLevel::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $levels = FacultyLevel::query()
        ->with('faculty')
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.faculties-levels.list-all-faculties-levels' , compact('levels') );
    }
}
