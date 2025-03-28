<?php

namespace App\Livewire\Board\Students\Devices;

use Livewire\Component;
use App\Models\{Student , Grade  , StudentInstallment , Unit , StudentUnit , StudentPayment , StudentLesson , CourseStudent ,  Group , EducationalSystem , Course , Teacher };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
use Auth;
use Carbon\Carbon;
class Manipluate extends Component
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




    public function updated()
    {
        $this->resetPage();
    }




    public function loginFromAnotherDevice()
    {

        foreach ($this->selectedStudents as $key => $selectedStudent) {

            $student = Student::find($key);

            if ($student) {
                $student->mobile_serial_number = null;
                $student->unique_device_id = null;
                $student->save();
                $student->tokens()->delete();
                $student->tokens()->delete();
            }
        }

        $this->dispatch('devicesRemoved');


    }

    public function mount() {

        $this->grades = Grade::select('name', 'id' )->get();
        $this->systems = EducationalSystem::select('name', 'id' )->get();
        $this->selectedCourses = Course::select('id' , 'title')->get();
    }

    #[Computed]
    public function courses()
    {
        return Course::when($this->teacher_id , function($query){
            $query->where('teacher_id' , $this->teacher_id );
        })
        ->select('title' , 'id'  , 'teacher_id')->get();
    }

    #[Computed]
    public function teachers()
    {
        return Teacher::select('name' , 'id')->get();
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

        ->when($this->teacher_id , function($query){
            $query->whereHas('courses' , function($query){
                $query->whereHas('course' , function($query){
                    $query->where('teacher_id' , $this->teacher_id );
                });
            });
        })
        ->when($this->course_id , function($query){
            $query->whereHas('courses' , function($query){
                $query->where('course_id' , $this->course_id );
            });
        })
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.students.devices.manipluate' , compact('students') );
    }
}
