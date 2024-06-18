<?php

namespace App\Livewire\Board\Courses;

use Livewire\Component;
use App\Models\Course;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllCourses extends Component
{

    use WithPagination , WithoutUrlPagination ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15 ;
    public $is_active = 'all';

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    public function updatedRows()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {

        $slide = Slide::find($itemId);
        if($slide) {
            Storage::delete(['slides/'.$slide->image]);
            $slide->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $courses = Course::when($this->is_active !='all' , function($query){
            $query->where('is_active' , $this->is_active);
        })->latest()->paginate($this->rows);

        return view('livewire.board.courses.list-all-courses' , compact('courses') );
    }
}
