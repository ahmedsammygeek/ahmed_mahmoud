<?php

namespace App\Livewire\Board\Library;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Computed;
use Storage;
use App\Models\{LessonFile ,  CourseStudent , Course , Teacher , Unit, Lesson , LessonVideo};
class ListAllFiles extends Component
{

    use WithPagination , WithoutUrlPagination ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15 ;
    public $is_active = 'all';
    public $teacher_id;
    public $course_id;
    public $unit_id;
    public $lesson_id;
    public $video_id;



    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  

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
        return Unit::where('course_id' , $this->course_id )->get();
    }


    #[Computed]
    public function lessons()
    {
        return Lesson::where('unit_id' , $this->unit_id )->get();
    }


    #[Computed]
    public function videos()
    {
        return LessonVideo::where('lesson_id' , $this->lesson_id )->get();
    }

    public function updatedRows()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        $file = LessonFile::find($itemId);
        if($file) {
            Storage::delete(['lesson_files/'.$file->image]);
            $file->delete();
            $this->dispatch('itemDeleted');
        }
    }

    public function donwloadFile($itemId)
    {
        $lesson_file = LessonFile::find($itemId);

        if ($lesson_file) {        
            return Storage::download('lesson_files/'.$lesson_file->file , $lesson_file->name );
        } else {

        }
    }

    public function render()
    {
        $files = LessonFile::with('video' , 'lesson' , 'lesson.unit.course' )
        ->when($this->teacher_id  , function($query){
            $query->whereHas('video' , function($query){
                $query->whereHas('lesson' , function($query){
                    $query->whereHas('unit' , function($query){
                        $query->whereHas('course' , function($query){
                            $query->where('teacher_id' , $this->teacher_id  );
                        });
                    });
                });
            });
        })
        ->when($this->course_id  , function($query){
            $query->whereHas('video' , function($query){
                $query->whereHas('lesson' , function($query){
                    $query->whereHas('unit' , function($query){
                        $query->where('course_id' , $this->course_id );
                    });
                });
            });
        })
        ->when($this->unit_id , function($query){
            $query->whereHas('video' , function($query){
                $query->whereHas('lesson' , function($query){
                    $query->where('unit_id' , $this->unit_id );
                });
            });
        }) 
        ->when($this->lesson_id , function($query){
            $query->whereHas('video' , function($query){
                $query->where('lesson_id' , $this->lesson_id );
            });
        }) 
        ->when($this->video_id , function($query){
            $query->where('video_id' , $this->video_id );
        }) 
        ->latest()
        ->paginate($this->rows);
        return view('livewire.board.library.list-all-files' , compact('files') );
    }
}
