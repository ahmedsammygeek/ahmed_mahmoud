<?php

namespace App\Livewire\Board\Videos;

use Livewire\Component;
use App\Models\{Student , Grade , EducationalSystem , Course  , Unit , Lesson , Teacher , LessonVideo };
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
    public $unit_id;
    public $lesson_id;
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
        $item = LessonVideo::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function updateVideoOrder($items)
    {
        foreach ($items as $item) {
            $video = LessonVideo::find($item['value']);
            if ($video) {
                $video->sorting = $item['order'];
                $video->save();
            }
        }
    }

    public function mount() {

        $this->grades = Grade::select('name', 'id' )->get();
        $this->systems = EducationalSystem::select('name', 'id' )->get();
    }

    #[Computed]
    public function teachers()
    {
        return Teacher::select('name' , 'id')->get();
    }


    #[Computed]
    public function courses()
    {
        return Course::when($this->teacher_id , function($query){
            $query->where('teacher_id' , $this->teacher_id );
        })
        ->select('title' , 'id')->get();
    }

    #[Computed]
    public function units()
    {
        return Unit::when($this->course_id , function($query){
            $query->where('course_id' , $this->course_id );
        })
        ->select('title' , 'id')->get();
    }


    #[Computed]
    public function lessons()
    {
        return Lesson::when($this->unit_id , function($query){
            $query->where('unit_id' , $this->unit_id );
        })
        ->select('title' , 'id')->get();
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
        ->when($this->course_id , function($query){
            $query->whereHas('lesson' , function($query){
                $query->whereHas('unit'  , function($query){
                    $query->where('course_id' , $this->course_id );
                });
            });
        })
        ->when($this->unit_id , function($query){
            $query->whereHas('lesson' , function($query){
                $query->where('unit_id' , $this->unit_id );
            });
        })

        ->when($this->lesson_id , function($query){
            $query->where('lesson_id' , $this->lesson_id );
        })
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
        ->orderBy('sorting' , 'ASC' )
        ->paginate($this->rows);

        return view('livewire.board.videos.list-all-videos' , compact('videos') );
    }
}
