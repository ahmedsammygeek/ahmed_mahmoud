<?php

namespace App\Livewire\Board\Students\Courses;

use Livewire\Component;
use App\Models\{Student , Grade  , StudentInstallment , LessonVideo , Unit , StudentUnit , StudentPayment , StudentLesson , CourseStudent ,  Group , EducationalSystem , Course , Teacher };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
use Auth;
use Carbon\Carbon;
class ListAllStudents extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;
    public $student_type;
    public $selectedCourses;
    public $search;
    public $grade_id;
    public $educational_system_id;
    public $course_id;
    public $teacher_id;
    public $grades;
    public $systems;
    public $is_active = 'all';
    public $selectedStudents = [];
    public $courses_count = 0;

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    #[Validate('required')]
    public $selected_course_id = [];

    #[Validate('required')]
    public $group_id;

    #[Validate('required')]
    public $purchase_price = 0;

    #[Validate('required')]
    public $paid ;

    #[Validate('required')]
    public $student_units = [] ;

    public $installment_months = 1;
    public $allow = true;


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

    public function AddMoreCourses()
    {
        $this->courses_count++;
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
        // dd($this->selected_course_id);


        return redirect(route('board.courses.students.create.step_two' , ['courses' => $this->selected_course_id , 'students' => $this->selectedStudents ]  ));

        $user_id = Auth::id();


        
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

        return view('livewire.board.students.courses.list-all-students' , compact('students') );
    }
}
