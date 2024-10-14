<?php

namespace App\Livewire\Board\Universities;

use Livewire\Component;
use App\Models\University;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllUniversities extends Component
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
        $item = University::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $universities = University::query()

        ->latest()->paginate($this->rows);

        return view('livewire.board.universities.list-all-universities' , compact('universities') );
    }
}
