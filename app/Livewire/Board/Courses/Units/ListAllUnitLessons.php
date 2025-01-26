<?php

namespace App\Livewire\Board\Courses\Units;

use Livewire\Component;
use App\Models\Lesson;
class ListAllUnitLessons extends Component
{

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

    public function render()
    {
        $lessons = Lesson::where('unit_id' , $this->unit->id )->orderBy( 'sorting' ,  'ASC' )->paginate(15);
        return view('livewire.board.courses.units.list-all-unit-lessons' , compact('lessons') );
    }
}
