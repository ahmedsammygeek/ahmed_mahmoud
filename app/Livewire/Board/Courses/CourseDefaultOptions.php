<?php

namespace App\Livewire\Board\Courses;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Teacher;
class CourseDefaultOptions extends Component
{

    public $force_face_detecting = false ; 
    public $speak_user_phone = false ; 
    public $show_phone_on_viedo = false ; 
    public $force_headphones = false ; 


    #[On('teacher-choosed')] 
    public function updateCourseDefaultValues($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);

        $this->force_face_detecting = (boolean)$teacher->force_face_detecting  ;
        $this->speak_user_phone =  (boolean)$teacher->speak_user_phone ;
        $this->show_phone_on_viedo = (boolean)$teacher->show_phone_on_viedo ;
        $this->force_headphones = (boolean)$teacher->force_headphones  ;    
    }




    public function render()
    {
        return view('livewire.board.courses.course-default-options');
    }
}
