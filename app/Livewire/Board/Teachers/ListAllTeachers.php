<?php

namespace App\Livewire\Board\Teachers;

use Livewire\Component;
use App\Models\{Teacher , Grade , EducationalSystem , Course  };
use Livewire\WithPagination;

use Storage;
class ListAllTeachers extends Component
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
        $teachers = Teacher::query()
        ->with(['user'])
        ->withCount('courses')
        ->when($this->search , function($query){
            $query
            ->where('name' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('mobile' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.teachers.list-all-teachers' , compact('teachers') );
    }
}
