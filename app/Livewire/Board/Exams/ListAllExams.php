<?php

namespace App\Livewire\Board\Exams;

use Livewire\Component;
use App\Models\{Exam  , Course , ExamQuestion , StudentExamAnswer , StudentExam } ;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllExams extends Component
{

    use WithPagination , WithoutUrlPagination ;
    protected $paginationTheme = 'bootstrap';
    public $rows;
    public $course_id;
    public $search;
    public $is_active = 'all';

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    public function updatedRows()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        $item = Exam::find($itemId);
        if($item) {
            $item->delete();
            ExamQuestion::where('exam_id' , $itemId )->delete();
            StudentExam::where('exam_id' , $itemId )->delete();
            StudentExamAnswer::where('exam_id' , $itemId )->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $exams = Exam::query()
        ->with(['course'])
        ->when($this->is_active !='all' , function($query){
            $query->where('is_active' , $this->is_active);
        })
        ->when($this->search , function($query){
            $query->where('title->ar', 'LIKE' , '%'.$this->search.'%' )->orWhere('title->en', 'LIKE' , '%'.$this->search.'%');
        })
        ->when($this->course_id , function($query){
            $query->where('course_id' , $this->course_id );
        })
        ->latest()
        ->paginate($this->rows);
        $courses = Course::select('id' , 'title' )->get();
        return view('livewire.board.exams.list-all-exams' , compact('exams' , 'courses') );
    }
}
