<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\{ CourseStudent};
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


    public function force_headphone($student_course_id)
    {
        $student_course = CourseStudent::find($student_course_id);
        if ($student_course) {
            $student_course->force_headphones = 1;
            $student_course->save();
        }
        $this->dispatch('changed');
    }

    public function un_force_headphonse($student_course_id)
    {
        $student_course = CourseStudent::find($student_course_id);
        if ($student_course) {
            $student_course->force_headphones = 0;
            $student_course->save();
        }
        $this->dispatch('changed');
    }


    public function disallow()
    {
        $this->validate();
        $course = CourseStudent::find($this->student_course_id);
        if ($course) {
            $course->allow = 0;
            $course->disable_reason = $this->not_allow_message;
            $course->save();
            $this->dispatch('changed');
            $this->dispatch('changed')->to(ListAllStudentCourses::class);
        }
    }

    #[On('allowStudentToWatchCourse')] 
    public function allow($course_id)
    {

        $course = CourseStudent::find($course_id);
        if ($course) {
            $course->allow = 1;
            $course->disable_reason = null;
            $course->save();
            $this->dispatch('changed');
            $this->dispatch('changed')->to(ListAllStudentCourses::class);
        }
    }


    public function render()
    {
        $student_courses = CourseStudent::with(['course', 'group' ])->where('student_id' , $this->student->id )->paginate(15);
        return view('livewire.board.students.list-all-student-courses' , compact('student_courses') );
    }
}
