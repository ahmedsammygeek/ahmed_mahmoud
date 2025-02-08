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
    public $selectAll  = false ;

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh'  ];  


    public function allowCourses()
    {
        $res = CourseStudent::whereIn('student_id' , $this->selectedStudents )
        ->where('course_id' , $this->selected_course_id )
        ->update([
            'allow' => 1 , 
            'disable_reason' => null ,
        ]);
        $this->selected_course_id = null;
        $this->dispatch('courseAllowededToStudents');
    }  

    public function disableCourses()
    {
        $res = CourseStudent::whereIn('student_id' , $this->selectedStudents )
        ->where('course_id' , $this->selected_course_id )
        ->update([
            'allow' => 0 , 
            'disable_reason' => $this->disable_reason ,
        ]);
        $this->selected_course_id = null;
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


    public function selectAllStudents()
    {
        $this->selectAll = !$this->selectAll;

        if ($this->selectAll) {
            $this->selectedStudents = $this->generateQuery()->pluck('id')->toArray();
        } else {
            $this->selectedStudents = [];
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
            $query->where('teacher_id' , $this->teacher_id );
        })
        ->select('title' , 'id')->get();
    }

    #[Computed]
    public function teachers()
    {
        return Teacher::select('name' , 'id')->get();
    }



    public function generateQuery()
    {
        return  Student::query()
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
                $query->whereHas('course' , function($query){
                    $query->where('teacher_id' , $this->teacher_id );
                });
            });
        })
        ->when($this->student_type, function($query){
            $query->where('student_type' , $this->student_type);
        });
    }


    public function render()
    {
        $students =  $this->generateQuery()->latest()
        ->paginate($this->rows);

        return view('livewire.board.students.courses.allow-courses-to-students' , compact('students') );
    }
}
