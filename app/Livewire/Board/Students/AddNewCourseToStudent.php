<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\{Course , CourseStudent , Group , StudentLesson };
use Livewire\Attributes\Computed;
use Auth;
use Livewire\Attributes\Validate; 
class AddNewCourseToStudent extends Component
{

    #[Validate('required')]
    public $course_id;

    public $group_id;

    public $student;
    public $allow = true;
    public $purchase_price = 0;




    #[Computed]
    public function groups()
    {
        return Group::where('course_id' , $this->course_id )->get();
    }


    public function updatedCourseId()
    {
        $course = Course::find($this->course_id);
        $this->purchase_price = $course->price;
    }

    public function save()
    {
        $this->validate(); 
        $student_course = new CourseStudent;
        $student_course->user_id = Auth::id();
        $student_course->student_id = $this->student->id;
        $student_course->course_id = $this->course_id;
        $student_course->group_id = $this->group_id;
        $student_course->save();

        if ($this->allow) {
            $course = Course::find($this->course_id);
            $course_lessons = $course->lessons()->pluck('lessons.id')->toArray();
            $user_id = Auth::id();
            $student_lessons = [];
            foreach ($course_lessons as $course_lesson) {
                $student_lessons[] = new StudentLesson([
                    'lesson_id' => $course_lesson , 
                    'user_id' => $user_id, 
                    'student_id' => $this->student->id , 
                    'allowed_views' => $course->default_view_number , 
                    'remains_views' => $course->default_view_number , 
                    'total_views_till_now' => 0  ,
                ]);
            }
            $this->student->lessons()->saveMany($student_lessons);
        }
        $this->dispatch('studentAddedToCourse');
        $this->dispatch('studentAddedToCourse')->to(ListAllStudentCourses::class);

    }

    public function render()
    {   
        $student_courses = CourseStudent::where('student_id' , $this->student->id )->pluck('course_id')->toArray();
        $courses = Course::select('id' , 'title' )->whereNotIn('id' , $student_courses )->get();
        return view('livewire.board.students.add-new-course-to-student' , compact('courses') );
    }
}
