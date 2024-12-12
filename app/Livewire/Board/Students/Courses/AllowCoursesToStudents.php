<?php

namespace App\Livewire\Board\Students\Courses;

use Livewire\Component;
use App\Models\{Student , Grade  , StudentInstallment , Unit , StudentUnit , StudentPayment , StudentLesson , CourseStudent ,  Group , EducationalSystem , Course , Teacher };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
use Auth;
use Carbon\Carbon;
class AllowCoursesToStudents extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;
    public $student_type;
    public $selectedCourses;
    public $search;
    public $grade_id;
    public $educational_system_id;
    public $selected_course_id;
    public $course_id;
    public $teacher_id;
    public $grades;
    public $systems;
    public $disable_reason;
    public $is_active = 'all';
    public $selectedStudents = [];

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh'  ];  



        public function allowCourses()
        {
            foreach ($this->selectedStudents as $selectedStudent) {
               
               $student_course = CourseStudent::where('course_id' , $this->selected_course_id )
               ->where('student_id' , $selectedStudent )
               ->first();

               if ($student_course) {
                   $student_course->allow = 1;
                   $student_course->disable_reason = null;
                   $student_course->save();
               }
            }
            $this->selected_course_id = null;
            $this->dispatch('courseAllowededToStudents');
        }  

        public function disableCourses()
        {
            foreach ($this->selectedStudents as $selectedStudent) {
               
               $student_course = CourseStudent::where('course_id' , $this->selected_course_id )
               ->where('student_id' , $selectedStudent )
               ->first();

               if ($student_course) {
                   $student_course->allow = 0;
                   $student_course->disable_reason = $this->disable_reason;
                   $student_course->save();
               }
            }

            $this->dispatch('courseDisabldToStudents');
        }


    public function updated()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        $item = Student::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }

    #[Computed]
    public function groups()
    {
        return Group::where('course_id' , $this->selected_course_id )->get();
    }


    #[Computed]
    public function units()
    {
        return Unit::where('course_id' , $this->selected_course_id )->get();
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


    public function addStudnetsToCourses()
    {

        $user_id = Auth::id();


        foreach ($this->selectedStudents as $selectedStudent) {

            $student = Student::find($selectedStudent);


            $student_course = new CourseStudent;
            $student_course->user_id = Auth::id();
            $student_course->student_id = $selectedStudent;
            $student_course->course_id = $this->selected_course_id;
            $student_course->group_id = $this->group_id;
            $student_course->save();


            $student_units = [];
            foreach ($this->student_units as $student_unit) {

                $student_units[] = new StudentUnit([
                    'student_id' => $selectedStudent , 
                    'user_id' => Auth::id() , 
                    'unit_id' => $student_unit , 
                    'is_allowed' => 1 , 
                ]);
            }

            $student->units()->saveMany($student_units);
            $course = Course::find($this->selected_course_id );
            $course_lessons = $course->lessons()->whereIn('lessons.unit_id' , $this->student_units )->pluck('lessons.id')->toArray();
            $student_lessons = [];
            foreach ($course_lessons as $course_lesson) {
                $student_lessons[] = new StudentLesson([
                    'lesson_id' => $course_lesson , 
                    'user_id' => $user_id, 
                    'student_id' => $selectedStudent , 
                    'allowed_views' => $course->default_view_number , 
                    'remains_views' => $course->default_view_number , 
                    'total_views_till_now' => 0  ,
                ]);
            }


            $student->lessons()->saveMany($student_lessons);

            $student_payment = new StudentPayment;
            $student_payment->student_id = $selectedStudent;
            $student_payment->user_id = Auth::id();
            $student_payment->course_id = $this->selected_course_id;
            $student_payment->type = 1; 
            $student_payment->amount = $this->paid;
            $student_payment->save();

            if ($this->paid != $this->purchase_price ) {
            // then we need to add installments
                $installment_amount = (($this->purchase_price - $this->paid ) / $this->installment_months);

                for ($i=0; $i < $this->installment_months ; $i++) { 
                    $student_installment = new StudentInstallment;
                    $student_installment->user_id = Auth::id();
                    $student_installment->student_id = $selectedStudent;
                    $student_installment->course_id = $this->selected_course_id;
                    $student_installment->amount = $installment_amount;
                    $student_installment->due_date = Carbon::now()->addMonths(($i +1));
                    $student_installment->is_paid = 0;
                    $student_installment->student_payment_id = null;
                    $student_installment->change_to_paid_by = null;
                    $student_installment->save();
                }


            }
            $this->dispatch('studentAddedToCourse');
        }

    }

    public function mount() {

        $this->grades = Grade::select('name', 'id' )->get();
        $this->systems = EducationalSystem::select('name', 'id' )->get();
        $this->selectedCourses = Course::select('id' , 'title')->get();
    }

    #[Computed]
    public function courses()
    {
        return Course::when($this->grade_id , function($query){
            $query->where('grade_id' , $this->grade_id );
        })
        ->when($this->teacher_id , function($query){
            $query->whereHas('teachers' , function($query){
                $query->where('teacher_id' , $this->teacher_id );
            });
        })
        ->select('title' , 'id')->get();
    }

    #[Computed]
    public function teachers()
    {
        return Teacher::when($this->course_id , function($query){
            $query->whereHas('courses' , function($query){
                $query->where('course_id' , $this->course_id);
            });
        })->select('name' , 'id')->get();
    }

    public function render()
    {
        $students = Student::query()
        ->with(['grade' , 'educationalSystem' ])
        ->when($this->search , function($query){
            $query
            ->where('name' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('mobile' ,  'LIKE' , '%'.$this->search.'%'  )
            ->orWhere('guardian_mobile' ,  'LIKE' , '%'.$this->search.'%' );
        })
        ->when($this->grade_id , function($query){
            $query->where('grade_id' , $this->grade_id );
        })
        ->when($this->educational_system_id , function($query){
            $query->where('educational_system_id' , $this->educational_system_id );
        })
        ->when($this->course_id , function($query){
            $query->whereHas('courses' , function($query){
                $query->where('course_id' , $this->course_id );
            });
        })
        ->when($this->teacher_id , function($query){
            $query->whereHas('courses' , function($query){
                $query->whereHas('CourseTeacher' , function($query){
                    $query->where('teacher_id' , $this->teacher_id );
                });
            });
        })
        ->when($this->student_type, function($query){
            $query->where('student_type' , $this->student_type);
        })
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.students.courses.allow-courses-to-students' , compact('students') );
    }
}
