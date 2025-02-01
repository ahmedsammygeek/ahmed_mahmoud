<?php

namespace App\Livewire\Board\Students\Videos;

use Livewire\Component;
use App\Models\{Student , Grade  , StudentInstallment , Unit , StudentUnit , StudentPayment , StudentLesson , CourseStudent ,  Group , EducationalSystem , Course , Teacher , Lesson };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
use Auth;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
class ListAllStudents extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;

    public $search;
    public $grade_id;
    public $lesson_id = [];
    public $educational_system_id;
    public $course_id;
    public $teacher_id;
    public $unit_id;
    public $grades;
    public $systems;
    public $is_active = 'all';
    public $selectedStudents = [];

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' , 'allStudentshasBeenSelected' => '$refresh'];  


    #[Validate('required')]
    public $allowed_views ;


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
    public function teachers()
    {
        return Teacher::select('name' , 'id')->get();
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
    public function groups()
    {
        return Group::where('course_id' , $this->selected_course_id )->get();
    }


    #[Computed]
    public function units()
    {
        return Unit::where('course_id' , $this->course_id )->get();
    }


    #[Computed]
    public function lessons()
    {
        return Lesson::where('unit_id' , $this->unit_id )->get();
    }

    public function selecteAllStudents() {

        $students_ids =   $this->selectedStudents = $this->generateQuery()->pluck('id')->toArray();
        $new_array = [];
        foreach ($students_ids as $students_id) {
            $new_array[$students_id] = true; 
        }
        $this->selectedStudents = $new_array;
        $this->dispatch('allStudentshasBeenSelected');
    }


    public function addStudnetsToCourses()
    {   

        $this->validate();
        
        if ($this->lesson_id) {
            foreach ($this->lesson_id as $one_lesson_id) {
                $students = StudentLesson::whereIn('student_id' ,  array_keys($this->selectedStudents) )
                ->where('lesson_id' , $one_lesson_id )
                ->whereHas('lesson' , function($query){
                    $query->whereHas('unit' , function($query){
                        $query->whereHas('course' , function($query){
                            $query->where('course_id' , $this->course_id );
                        });
                    });
                })
                ->increment( 'allowed_views' , $this->allowed_views );
            }
        } else {
            $students = StudentLesson::whereIn('student_id' ,  array_keys($this->selectedStudents) )
            ->whereHas('lesson' , function($query){
                $query->whereHas('unit' , function($query){
                    $query->whereHas('course' , function($query){
                        $query->where('course_id' , $this->course_id );
                    });
                });
            })
            ->increment( 'allowed_views' , $this->allowed_views );
        }

        $this->dispatch('studentAddedToCourse');
    }

    public function mount() {

        $this->grades = Grade::select('name', 'id' )->get();
        $this->systems = EducationalSystem::select('name', 'id' )->get();
        $this->selectedCourses = Course::select('id' , 'title')->get();
    }


    public function generateQuery()
    {
        return Student::query()
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
        ->latest();
    }


    public function render()
    {
        $students = $this->generateQuery()->paginate($this->rows);

        return view('livewire.board.students.videos.list-all-students' , compact('students') );
    }
}
