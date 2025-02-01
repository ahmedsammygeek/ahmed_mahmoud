<?php

namespace App\Livewire\Board\Library;

use Livewire\Component;
use App\Models\Slide;
use App\Models\LessonFile;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Storage;
class ListAllFiles extends Component
{

    use WithPagination , WithoutUrlPagination ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15 ;
    public $is_active = 'all';

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


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
        $files = LessonFile::with('video' , 'lesson' , 'lesson.unit.course' )->latest()->paginate($this->rows);
        return view('livewire.board.library.list-all-files' , compact('files') );
    }
}
