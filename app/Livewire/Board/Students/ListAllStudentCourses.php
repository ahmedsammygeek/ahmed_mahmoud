<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\{CourseTeacherGroupStudent , Course };
use Livewire\Attributes\On; 
use Livewire\Attributes\Validate;
class ListAllStudentCourses extends Component
{
    public $student;

    #[Validate('required')]
    public $not_allow_message;


    public $student_course_id;

    #[On('studentAddedToCourse')] 
    public function updateStduentCoursesList()
    {   
        $refresh;
    }

    #[On('changed')] 
    public function updateStduentCoursesListAfterChange()
    {   
        $refresh;
    }


    


    public function disallow()
    {
        $this->validate();
        $course = CourseTeacherGroupStudent::find($this->student_course_id);
        if ($course) {
            $course->allow = 0;
            $course->not_allow_message = $this->not_allow_message;
            $course->save();
            $this->dispatch('changed');
            $this->dispatch('changed')->to(ListAllStudentCourses::class);
        }
    }

    #[On('allowStudentToWatchCourse')] 
    public function allow($course_id)
    {

        $course = CourseTeacherGroupStudent::find($course_id);
        if ($course) {
            $course->allow = 1;
            $course->not_allow_message = null;
            $course->save();
            $this->dispatch('changed');
            $this->dispatch('changed')->to(ListAllStudentCourses::class);
        }
    }


    public function render()
    {
        $courses = CourseTeacherGroupStudent::where('student_id' , $this->student->id )->paginate(15);
        return view('livewire.board.students.list-all-student-courses' , compact('courses') );
    }
}
