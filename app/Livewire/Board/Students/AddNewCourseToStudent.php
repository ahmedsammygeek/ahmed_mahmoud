<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\{Course , CourseStudent  , LessonVideo , Unit  , StudentUnit , Group , StudentLesson , StudentInstallment , StudentPayment };
use Livewire\Attributes\Computed;
use Auth;
use Carbon\Carbon;
use Livewire\Attributes\Validate; 
use Jantinnerezo\LivewireAlert\LivewireAlert;
class AddNewCourseToStudent extends Component
{   
    use LivewireAlert;

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

    public $installment_months = [] ;

    public $installment_amounts = [] ;



    public $installment_months_count = 1;
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


    public function addMoreInstallments()
    {
        $this->installment_months_count++;
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
        if ($this->paid < $this->purchase_price ) {

            if (count($this->installment_months) != count($this->installment_amounts)) {
                $this->alert('error' , 'برجاء تفقد عدد الاقسط و تاريخ الاستحقاق');
                return;
            }

            if (array_sum($this->installment_amounts) !=  ($this->purchase_price - $this->paid) ) {
                $this->alert('error' , 'برجاء تفقد عدد الاقسط و تاريخ الاستحقاق');
                return;
            }


            for ($i=0; $i < count($this->installment_months) ; $i++) { 
                $student_installment = new StudentInstallment;
                $student_installment->user_id = Auth::id();
                $student_installment->student_id = $this->student->id;
                $student_installment->course_id = $this->course_id ;
                $student_installment->amount = $this->installment_amounts[$i];
                $student_installment->due_date = $this->installment_months[$i];
                $student_installment->is_paid = 0;
                $student_installment->student_payment_id = null;
                $student_installment->change_to_paid_by = null;
                $student_installment->save();
            }
        } 

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
            $videos = LessonVideo::whereHas('lesson' , function($query){
                $query->whereIn('unit_id' , $this->student_units );
            })->get();
            $student_lessons = [];
            foreach ($videos as $video) {
                $student_lessons[] = new StudentLesson([
                    'lesson_id' => $video->lesson_id , 
                    'user_id' => $user_id, 
                    'student_id' => $this->student->id , 
                    'allowed_views' => $course->default_view_number , 
                    'remains_views' => $course->default_view_number , 
                    'total_views_till_now' => 0  ,
                    'video_id' => $video->id
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
        $this->dispatch('studentAddedToCourse');
        $this->dispatch('studentAddedToCourse')->to(ListAllStudentCourses::class);

    }

    public function render()
    {   
        $student_courses = CourseStudent::where('student_id' , $this->student->id )->pluck('course_id')->toArray();
        $courses = Course::whereNotIn('id' , $student_courses )->select('id' , 'title' )->get();
        return view('livewire.board.students.add-new-course-to-student' , compact('courses') );
    }
}
