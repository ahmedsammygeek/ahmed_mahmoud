<?php

namespace App\Livewire\Board\Courses\Units;

use Livewire\Component;
use App\Models\{Lesson , StudentLesson , LessonFile};
use Livewire\WithPagination;
use Storage;
use App\Jobs\DeleteLessonFileJob;
class ListAllUnitLessons extends Component
{   
    use WithPagination;

    public $unit;
    public $course;

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  

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

    
    public function deleteItem($item_id)
    {
        $lesson = Lesson::find($item_id);

        if($lesson) {
            dispatch(new DeleteLessonFileJob($lesson));
            LessonFile::where('lesson_id'  , $item_id )->delete();
            StudentLesson::where('lesson_id'  , $item_id )->delete();
            $lesson->delete();
            $this->dispatch('itemDeleted');
        }
    }

    public function render()
    {
        $lessons = Lesson::where('unit_id' , $this->unit->id )->orderBy( 'sorting' ,  'ASC' )->paginate(60);
        return view('livewire.board.courses.units.list-all-unit-lessons' , compact('lessons') );
    }
}
