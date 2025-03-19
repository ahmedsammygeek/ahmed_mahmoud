<?php

namespace App\Livewire\Board\Students\Courses;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\{Course , Teacher , Unit , Group};
class AddCourseToStudent extends Component
{
    public $student;
    public $course_id;
    public $teacher_id;
    public $units_id;
    public $online_library = true;
    public $paid = 0 ;
    public $purchase_price = 0;
    public $installment_months = [] ;
    public $installment_amounts = [] ;
    public $installment_months_count = 1;


    public function addMoreInstallments()
    {
        $this->installment_months_count++;
    }

    

    #[Computed]
    public function teachers()
    {
        return Teacher::select('name' , 'id' )->get();
    }

    #[Computed]
    public function courses()
    {
        return Course::select('title' , 'id' , 'teacher_id' )
        ->where('teacher_id' , $this->teacher_id )
        ->get();
    }

    #[Computed]
    public function units()
    {
        return Unit::select('title' , 'id' , 'course_id' )
        ->where('course_id' , $this->course_id )
        ->get();
    }


    #[Computed]
    public function groups()
    {
        return Group::select('name' , 'id' , 'course_id' )
        ->where('course_id' , $this->course_id )
        ->get();
    }



    public function updatedCourseId()
    {
        $course = Course::find($this->course_id);
        $this->purchase_price = $course->price;
    }



    public function updated( $property ,  $value)
    {
       // dd($property , $value);
    }


    public function render()
    {
        return view('livewire.board.students.courses.add-course-to-student');
    }
}
