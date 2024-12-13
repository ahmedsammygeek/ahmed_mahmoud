<?php

namespace App\Livewire\Board\Admins;

use Livewire\Component;
use App\Models\{User};
use Livewire\WithPagination;

use Storage;
class ListAllAdmins extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 10;
    public $search;

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    public function updated()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        $item = Teacher::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }



    public function render()
    {
        $admins = User::query()
        ->where('type' , 1 )
        ->with(['user'])
        ->when($this->search , function($query){
            $query
            ->where('name' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('email' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.admins.list-all-admins' , compact('admins') );
    }
}
