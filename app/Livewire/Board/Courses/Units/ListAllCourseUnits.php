<?php

namespace App\Livewire\Board\Courses\Units;

use Livewire\Component;
use App\Models\Unit;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
class ListAllCourseUnits extends Component
{

    use WithPagination , WithoutUrlPagination ;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  
    public $course;
    public $search;
    public $rows = 15;

    public function updatedRows()
    {
        $this->resetPage();
    }

    public function deleteItem($item_id)
    {

        $item = Unit::find($item_id);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }




    public function render()
    {
        $units = Unit::where('course_id' , $this->course->id )
        ->when($this->search , function($query){
            $query->where('title->ar' , 'LIKE' , '%'.$this->search.'%' )->orWhere('title->en' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        ->latest()
        ->paginate($this->rows);
        return view('livewire.board.courses.units.list-all-course-units' , compact('units') );
    }
}
