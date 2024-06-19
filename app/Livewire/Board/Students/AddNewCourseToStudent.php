<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\{Course , Teacher , CourseTeacherGroup , CourseTeacherGroupStudent };
use Livewire\Attributes\Computed;
use Auth;
use Livewire\Attributes\Validate; 
class AddNewCourseToStudent extends Component
{

    #[Validate('required')]
    public $course_id;
    
    #[Validate('required')]
    public $teacher_id;

    #[Validate('required')]
    public $purchase_price = 0 ;

    #[Validate('required')]
    public $deposit ;

    #[Validate('required')]
    public $group_id ;

    public $student;
    public $allow = true;



    public function updatedCourseId()
    {
        $course = Course::find($this->course_id);
        if ($course) {
            $this->purchase_price = $course->price;
        }

    }

    #[Computed]
    public function teachers()
    {
        return Teacher::whereHas('courses' , function($query){
            $query->where('course_id' , $this->course_id );
        })->get();
    }


    #[Computed]
    public function groups()
    {
        return CourseTeacherGroup::whereHas('CourseTeacher' , function($query){
            $query->where([
                ['teacher_id' , '=' , $this->teacher_id ] , 
                ['course_id' , '=' , $this->course_id ] , 
            ]);
        })->get();
    }

    public function save()
    {
        $this->validate(); 
        
        $CourseTeacherGroupStudent = new CourseTeacherGroupStudent;
        $CourseTeacherGroupStudent->user_id = Auth::id();
        $CourseTeacherGroupStudent->student_id = $this->student->id;
        $CourseTeacherGroupStudent->purchase_price = $this->purchase_price;
        $CourseTeacherGroupStudent->deposit = $this->deposit;
        $CourseTeacherGroupStudent->course_teacher_group_id = $this->group_id;
        $CourseTeacherGroupStudent->save();
        $this->dispatch('studentAddedToCourse');
        $this->dispatch('studentAddedToCourse')->to(ListAllStudentCourses::class);

    }

    public function render()
    {   
        $student_courses = Course::whereHas('teachers' , function($query)  {
            $query->whereHas('groups' , function($query) {
                $query->whereHas('students' , function($query) {
                    $query->where('student_id' , $this->student->id );
                });
            });
        })->pluck('id')->toArray();

        $courses = Course::select('id' , 'title' )->whereNotIn('id' , $student_courses )->get();
        return view('livewire.board.students.add-new-course-to-student' , compact('courses') );
    }
}
