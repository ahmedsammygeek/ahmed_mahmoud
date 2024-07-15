<?php

namespace App\Livewire\Board\Exams;

use Livewire\Component;
use App\Models\{StudentExam} ;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ListAllExamStudents extends Component
{

    use WithPagination , WithoutUrlPagination ;
    protected $paginationTheme = 'bootstrap';
    public $rows;
    public $exam;
    public $search;

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
        $exam_students = StudentExam::where('exam_id' , $this->exam->id )
        ->with(['student'])
        ->when($this->search , function($query){
            $query->where('title->ar', 'LIKE' , '%'.$this->search.'%' )->orWhere('title->en', 'LIKE' , '%'.$this->search.'%');
        })
        ->latest()
        ->paginate($this->rows);


        return view('livewire.board.exams.list-all-exam-students' , compact('exam_students') );
    }
}
