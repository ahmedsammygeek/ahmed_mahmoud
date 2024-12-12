<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\{Course , CourseStudent , Unit  , StudentUnit , Group , StudentLesson , StudentInstallment , StudentPayment };
use Livewire\Attributes\Computed;
use Auth;
use Carbon\Carbon;
use Livewire\Attributes\Validate; 
class AddNewCourseToStudent extends Component
{

    #[Validate('required')]
    public $course_id;

    #[Validate('required')]
    public $group_id;

    #[Validate('required')]
    public $purchase_price = 0;

    #[Validate('required')]
    public $paid ;

    #[Validate('required')]
    public $student_units ;



    public $installment_months = 1;
            public $in_office = true;
            public $office_library = true;
            public $online_library = true;
            public $allow = true;

    public $student;


    #[Computed]
    public function groups()
    {
        return Group::where('course_id' , $this->course_id )->get();
    }


    #[Computed]
    public function units()
    {
        return Unit::where('course_id' , $this->course_id )->get();
    }


    public function updatedCourseId()
    {
        $course = Course::find($this->course_id);
        $this->purchase_price = $course->price;
    }


    #[Computed]
    public function single_installment()
    {
        return    ($this->purchase_price - $this->paid) / $this->installment_months   ;
    }

    public function save()
    {
        $this->validate(); 

        $user_id = Auth::id();

        $student_course = new CourseStudent;
        $student_course->user_id = Auth::id();
        $student_course->student_id = $this->student->id;
        $student_course->course_id = $this->course_id;
        $student_course->group_id = $this->group_id;
        $student_course->in_office = $this->in_office;
        $student_course->office_library = $this->office_library;
        $student_course->online_library = $this->online_library;
        $student_course->is_online = $this->allow;
        $student_course->save();

        // not we need to add units to user

        $student_units = [];
        foreach ($this->student_units as $student_unit) {
            
            $student_units[] = new StudentUnit([
                'student_id' => $this->student->id , 
                'user_id' => Auth::id() , 
                'unit_id' => $student_unit , 
                'is_allowed' => 1 , 
            ]);
        }

        $this->student->units()->saveMany($student_units);

        if ($this->allow) {
            $course = Course::find($this->course_id);
            $course_lessons = $course->lessons()->whereIn('lessons.unit_id' , $this->student_units )->pluck('lessons.id')->toArray();
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


        $student_payment = new StudentPayment;
        $student_payment->student_id = $this->student->id;
        $student_payment->user_id = Auth::id();
        $student_payment->course_id = $this->course_id;
        $student_payment->type = 1; // for purchases
        $student_payment->amount = $this->paid;
        $student_payment->save();

        if ($this->paid != $this->purchase_price ) {
            // then we need to add installments
            $installment_amount = (($this->purchase_price - $this->paid ) / $this->installment_months);

            for ($i=0; $i < $this->installment_months ; $i++) { 
                $student_installment = new StudentInstallment;
                $student_installment->user_id = Auth::id();
                $student_installment->student_id = $this->student->id;
                $student_installment->course_id = $this->course_id ;
                $student_installment->amount = $installment_amount;
                $student_installment->due_date = Carbon::now()->addMonths(($i +1));
                $student_installment->is_paid = 0;
                $student_installment->student_payment_id = null;
                $student_installment->change_to_paid_by = null;
                $student_installment->save();
            }


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
