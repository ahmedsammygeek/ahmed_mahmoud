<?php

namespace App\Livewire\Board\Groups;

use Livewire\Component;
use App\Models\CourseTeacherGroup;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllGroups extends Component
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
        $item = CourseTeacherGroup::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $groups = CourseTeacherGroup::query()
        ->with(['CourseTeacher'])
        ->when($this->is_active !='all' , function($query){
            $query->where('is_active' , $this->is_active);
        })->latest()->paginate($this->rows);

        return view('livewire.board.groups.list-all-groups' , compact('groups') );
    }
}
