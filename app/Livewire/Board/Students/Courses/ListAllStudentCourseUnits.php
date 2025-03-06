<?php

namespace App\Livewire\Board\Students\Courses;

use Livewire\Component;
use App\Models\StudentUnit;
class ListAllStudentCourseUnits extends Component
{
    public $student;
    public $course;


    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    public function deleteItem($itemId)
    {
        $item = StudentUnit::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }



    public function disallow($student_unit_id)
    {   
        $student_unit = StudentUnit::where('id' , $student_unit_id )->first();
        if ($student_unit) {
            $student_unit->is_allowed = 0;
            $student_unit->save();
        }
        $this->dispatch('updatedSuccessfully');
    }


    public function allow($student_unit_id)
    {
        $student_unit = StudentUnit::where('id' , $student_unit_id )->first();
        if ($student_unit) {
            $student_unit->is_allowed = 1;
            $student_unit->save();
        }
        $this->dispatch('updatedSuccessfully');
    }

    


    public function render()
    {
        $student_units = StudentUnit::query()
        ->with(['unit' , 'user'])
        ->where('student_id'  , $this->student->id )
        ->whereHas('unit' , function($query){
            $query->where('course_id' , $this->course->id );
        })->get();
        return view('livewire.board.students.courses.list-all-student-course-units' , compact('student_units'));
    }
}
