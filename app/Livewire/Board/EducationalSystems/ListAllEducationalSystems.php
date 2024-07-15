<?php

namespace App\Livewire\Board\EducationalSystems;

use Livewire\Component;
use App\Models\EducationalSystem;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllEducationalSystems extends Component
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
        $item = EducationalSystem::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $systems = EducationalSystem::query()

        ->latest()->paginate($this->rows);

        return view('livewire.board.educational-systems.list-all-educational-systems' , compact('systems') );
    }
}
