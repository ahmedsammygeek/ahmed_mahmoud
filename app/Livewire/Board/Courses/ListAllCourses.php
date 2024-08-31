<?php

namespace App\Livewire\Board\Courses;

use Livewire\Component;
use App\Models\{Course, CourseStudent };
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

        $course = Course::find($itemId);
        if($course) {
            Storage::delete(['slides/'.$course->image]);
            $course->delete();

            CourseStudent::where('course_id' , $course->id )->delete();

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
