<?php

namespace App\Livewire\Board\Students\Videos;

use Livewire\Component;
use App\Models\{Student , Grade  , StudentInstallment , Unit , StudentUnit , StudentPayment , StudentLesson , CourseStudent ,  Group , EducationalSystem , Course , Teacher, LessonVideo , Lesson };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
use Auth;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ListAllStudents extends Component
{

    use WithPagination  , LivewireAlert ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;

    public $search;
    public $grade_id;

    public $educational_system_id;
    public $course_id;
    public $teacher_id;
    public $unit_id;
    public $grades;
    public $systems;
    public $allowed_views;
    public $lesson_id;
    public $is_active = 'all';
    public $selectedStudents = [];
    public $selectedVideos = [];
    public $selectAll = false ;
    public $selectAllVideos = true ;


    protected $listeners = ['deleteItem' , 'openViewsModal' , 'itemDeleted' => '$refresh' , 'allStudentshasBeenSelected' => '$refresh'];  

    protected $rules = [
        'allowed_views' => 'required',
    ];

    public function resetAllFilters()
    {
        $this->educational_system_id = null;
        $this->course_id = null;
        $this->teacher_id = null;
        $this->grade_id = null;
        $this->search = null;

    }

    public function SelectAllVideosddddd()
    {
        $this->selectAllVideos = !$this->selectAllVideos;
        if ($this->selectAllVideos) {
            $this->selectedVideos = LessonVideo::whereIn('lesson_id' , $this->lessons()->pluck('id')->toArray() )->pluck('id')->toArray();
        } else {
            $this->selectedVideos = [];
        }
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
        })->select('title' , 'id')->get();
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

    public function selectAllStudents() {

        $this->selectAll = !$this->selectAll;
        if ($this->selectAll) {
            $this->selectedStudents =  $this->generateQuery()->pluck('id')->toArray()  ;
        } else {
            $this->selectedStudents =  []  ;
        }
    }


    public function openViewsModal()
    {
        if (!$this->course_id) {
            $this->dispatch('close-add-views-modal');
            $this->alert('error' , 'choose course first please' );
            return ;
        }

        $this->dispatch('open-add-views-modal');
    }

    public function addStudnetsToCourses()
    {   
        $this->validate();
        // dd(array_keys($this->selectedStudents) , $this->selectedStudents);
        if ($this->lesson_id) {
            foreach ($this->lesson_id as $one_lesson_id) {
                $students = StudentLesson::whereIn('student_id' ,  $this->selectedStudents )
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
            $students = StudentLesson::whereIn('student_id' ,  $this->selectedStudents )
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

        // $this->selectAllVideos = !$this->selectAllVideos;
        if ($this->selectAllVideos) {
            $this->selectAllVideos = LessonVideo::whereIn('lesson_id' , $this->lessons()->pluck('id')->toArray() )->pluck('id')->toArray();
        } else {
            $this->selectAllVideos = [];
        }
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
        ->when($this->unit_id , function($query){
            $query->whereHas('units' , function($query){
                $query->where('unit_id' , $this->unit_id );
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
