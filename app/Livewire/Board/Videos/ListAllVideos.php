<?php

namespace App\Livewire\Board\Videos;

use Livewire\Component;
use App\Models\{Student , Grade , EducationalSystem , Course , Teacher , LessonVideo };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
class ListAllVideos extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;
    public $student_type;
    public $search;
    public $grade_id;
    public $educational_system_id;
    public $course_id;
    public $teacher_id;
    public $grades;
    public $systems;
    public $is_active = 'all';

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


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


    public function mount() {

        $this->grades = Grade::select('name', 'id' )->get();
        $this->systems = EducationalSystem::select('name', 'id' )->get();
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
        $videos = LessonVideo::query()
        ->with(['lesson' , 'user' ])
        ->when($this->search , function($query){
            $query
            ->where('title' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('title' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        // ->when($this->grade_id , function($query){
        //     $query->where('grade_id' , $this->grade_id );
        // })
        // ->when($this->educational_system_id , function($query){
        //     $query->where('educational_system_id' , $this->educational_system_id );
        // })
        // ->when($this->course_id , function($query){
        //     $query->whereHas('courses' , function($query){
        //         $query->where('course_id' , $this->course_id );
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

        return view('livewire.board.videos.list-all-videos' , compact('videos') );
    }
}
