<?php

namespace App\Livewire\Board\Questions;

use Livewire\Component;
use App\Models\Question;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllQuestions extends Component
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
        $item = Question::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function render()
    {
        $questions = Question::query()
        ->with(['course' , 'user' ])
        ->when($this->is_active !='all' , function($query){
            $query->where('is_active' , $this->is_active);
        })->latest()->paginate($this->rows);

        return view('livewire.board.questions.list-all-questions' , compact('questions') );
    }
}
