<?php

namespace App\Livewire\Board\Splashes;

use Livewire\Component;
use App\Models\Splash;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllSplashes extends Component
{

    use WithPagination , WithoutUrlPagination ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 2 ;
    public $is_active = 'all';

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    public function updatedRows()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        // dd($itemId);
        $Splash = Splash::find($itemId);
        if($Splash) {
            Storage::delete(['splashes/'.$Splash->image]);
            $Splash->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $splashes = Splash::when($this->is_active !='all' , function($query){
            $query->where('is_active' , $this->is_active);
        })->latest()->paginate($this->rows);

        return view('livewire.board.splashes.list-all-splashes' , compact('splashes') );
    }
}
