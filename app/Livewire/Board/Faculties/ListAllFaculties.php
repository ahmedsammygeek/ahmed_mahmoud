<?php

namespace App\Livewire\Board\Faculties;

use Livewire\Component;
use App\Models\Faculty;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllFaculties extends Component
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
        $item = Faculty::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $faculties = Faculty::query()

        ->latest()->paginate($this->rows);

        return view('livewire.board.faculties.list-all-faculties' , compact('faculties') );
    }
}
