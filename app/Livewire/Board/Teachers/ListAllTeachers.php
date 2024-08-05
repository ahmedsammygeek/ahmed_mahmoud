<?php

namespace App\Livewire\Board\Teachers;

use Livewire\Component;
use App\Models\{Teacher , Grade , EducationalSystem , Course  };
use Livewire\WithPagination;

use Storage;
class ListAllTeachers extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 10;
    public $search;
    public $grade_id;
    public $educational_system_id;
    public $course_id;
    public $grades;
    public $systems;
    public $courses;
    public $is_active = 'all';

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    public function updated()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        $item = Teacher::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function mount() {

        $this->grades = Grade::select('name', 'id' )->get();
        $this->systems = EducationalSystem::select('name', 'id' )->get();
        $this->courses = Course::select('title', 'id' , 'teacher_id' )->get();
    }


    public function render()
    {
        $teachers = Teacher::query()
        ->with(['user'  ])
        ->withCount('courses')
        ->when($this->search , function($query){
            $query
            ->where('name' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('mobile' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        // ->when($this->grade_id , function($query){
        //     $query->where('grade_id' , $this->grade_id );
        // })
        // ->when($this->educational_system_id , function($query){
        //     $query->where('educational_system_id' , $this->educational_system_id );
        // })
        // ->when($this->course_id , function($query){
        //     $query->whereHas('courses' , function($query){
        //         $query->whereHas('CourseTeacher' , function($query){
        //             $query->where('course_id' , $this->course_id );
        //         });
        //     });
        // })
        // ->when($this->teacher_id , function($query){
        //     $query->whereHas('courses' , function($query){
        //         $query->whereHas('CourseTeacher' , function($query){
        //             $query->where('teacher_id' , $this->teacher_id );
        //         });
        //     });
        // })
        // ->when($this->student_type, function($query){
        //     $query->where('student_type' , $this->student_type);
        // })
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.teachers.list-all-teachers' , compact('teachers') );
    }
}
