<?php

namespace App\Livewire\Board\Courses\Units;

use Livewire\Component;
use App\Models\Lesson;
use Livewire\WithPagination;
class ListAllUnitLessons extends Component
{   
    use WithPagination;

    public $unit;
    public $course;

    public function updateLessonOrder($items)
    {
        foreach ($items as $item) {
            $lesson = Lesson::find($item['value']);
            if ($lesson) {
                $lesson->sorting = $item['order'];
                $lesson->save();
            }
        }
    }

    
    public function deleteItem()
    {
        // code...
    }

    public function render()
    {
        $lessons = Lesson::where('unit_id' , $this->unit->id )->orderBy( 'sorting' ,  'ASC' )->paginate(60);
        return view('livewire.board.courses.units.list-all-unit-lessons' , compact('lessons') );
    }
}
