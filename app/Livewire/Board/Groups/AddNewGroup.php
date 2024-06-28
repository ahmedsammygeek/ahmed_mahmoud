<?php

namespace App\Livewire\Board\Groups;

use Livewire\Component;
use App\Models\{Course , Teacher , CourseTeacher , CourseTeacherGroup };

use Livewire\Attributes\Computed;

class AddNewGroup extends Component
{

    public $course_id;
    public $course_teacher_id;
    public $group_days = 1 ;
    public $days = [];
    public $from = [];
    public $to = [];

    #[Computed]
    public function courseTeachers()
    {
        return CourseTeacher::with('teacher')->whereHas('course' , function($query){
            $query->where('course_id' , $this->course_id);
        })->get();
    }

    public function addMoreDays()
    {
        $this->group_days++;
    }


    public function save()
    {
        sleep(4);

        
    }

    public function render()
    {
        $courses = Course::select('id' , 'title' )->get();
        return view('livewire.board.groups.add-new-group' , compact('courses') );
    }
}
