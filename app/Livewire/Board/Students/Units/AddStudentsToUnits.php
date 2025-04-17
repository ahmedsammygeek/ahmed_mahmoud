<?php

namespace App\Livewire\Board\Students\Units;

use Livewire\Component;
use App\Models\{Student  , Unit , StudentUnit , LessonVideo  , StudentLesson , CourseStudent  , Course , Teacher };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Auth;
class AddStudentsToUnits extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;
    public $student_type;
    public $selectedCourses;
    public $search;
    public $selected_course_id;
    public $course_id;
    public $teacher_id;
    public $grades;
    public $systems;
    public $disable_reason;
    public $is_active = 'all';
    public $selectAll = false ;
    public $selectedStudents = [];
    public $studentsUnits = [];
    public $selectedUnits = [];
    public $choosed_teacher_id;
    public $choosed_course_id;

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh'  ];  




    public function updated()
    {
        $this->resetPage();
    }


    public function resetFilters()
    {
        $this->selectedStudents = [];
        $this->teacher_id = null;
        $this->selectedCourses = null;
        $this->course_id = null;
        $this->studentsUnits = [];
        $this->selectedUnits = [];
    }



    public function addUnitsToStudents()
    {


        foreach ($this->selectedUnits as $selectedUnit) {

            $default_course_options = get_default_course_options($this->choosed_course_id);
            $default_course_views = get_default_course_views($this->choosed_course_id);

            foreach ($this->selectedStudents as  $selectedStudent) {

                $student_unit = StudentUnit::where('student_id' , $selectedStudent )
                ->where('unit_id' , $selectedUnit )
                ->first();

                if (!$student_unit) {

                    $student = Student::find($selectedStudent);

                    $student_unit = new StudentUnit;
                    $student_unit->student_id = $selectedStudent;
                    $student_unit->unit_id = $selectedUnit;
                    $student_unit->user_id = Auth::id();
                    $student_unit->is_allowed = 1;
                    $student_unit->save();

                    $videos = LessonVideo::whereHas('lesson' , function($query) use($selectedUnit) {
                        $query->where('unit_id' , $selectedUnit );
                    })->get();
                    $student_lessons = [];

                    foreach ($videos as $video) {
                        $student_lessons[] = new StudentLesson([
                            'lesson_id' => $video->lesson_id , 
                            'user_id' => Auth::id(), 
                            'student_id' => $selectedStudent , 
                            'allowed_views' => $default_course_views , 
                            'remains_views' => $default_course_views , 
                            'total_views_till_now' => 0  ,
                            'video_id' => $video->id
                        ]);
                    }
                    $student->lessons()->saveMany($student_lessons);
                }

                $student = Student::find($selectedStudent);            
            }
        }

        // $this->selectedStudents = [];

        // $this->dispatch('devicesRemoved');

        $this->resetFilters();
        $this->dispatch('unitsAdded');


    }

    public function mount() {
        $this->selectedCourses = Course::select('id' , 'title')->get();
    }

    #[Computed]
    public function choosed_teachers()
    {
        return Teacher::select('name' , 'id')->get();
    }


    #[Computed]
    public function choosed_courses()
    {
        return Course::query()
        ->where('teacher_id' , $this->choosed_teacher_id )
        ->select('title' , 'id'  , 'teacher_id')->get();
    }


    #[Computed]
    public function choosed_units()
    {
        return Unit::query()
        ->where('course_id' , $this->choosed_course_id )
        ->select('title' , 'id' , 'course_id')->get();
    }





    #[Computed]
    public function courses()
    {
        return Course::query()
        ->where('teacher_id' , $this->teacher_id )
        ->select('title' , 'id'  , 'teacher_id')->get();
    }


    #[Computed]
    public function units()
    {
        return Unit::query()
        ->where('course_id' , $this->course_id )
        ->select('title' , 'id' , 'course_id')->get();
    }

    #[Computed]
    public function teachers()
    {
        return Teacher::select('name' , 'id')->get();
    }


    public function selectAllStudents() {

        $this->selectAll = !$this->selectAll;
        if ($this->selectAll) {
            $this->selectedStudents =  $this->generateQuery()->pluck('id')->toArray()  ;
        } else {
            $this->selectedStudents =  []  ;
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
        ->when($this->studentsUnits , function($query){
            $query->whereHas('units' ,function($query){
                $query->whereIn('unit_id' , $this->studentsUnits );
            });
        });
    }

    public function render()
    {
        $students =  $this->generateQuery()
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.students.units.add-students-to-units' , compact('students') );
    }
}
