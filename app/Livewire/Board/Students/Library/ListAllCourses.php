<?php

namespace App\Livewire\Board\Students\Library;

use Livewire\Component;
use App\Models\LibraryStudent;
class ListAllCourses extends Component
{
    public $student;


    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    public function deleteItem($itemId)
    {
        $item = LibraryStudent::find($itemId);
        if($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }


    public function manipluateDownloadOption($student_library_course_id)
    {
        $student_library_course = LibraryStudent::find($student_library_course_id);
        if ($student_library_course) {
            $student_library_course->allow_download = !$student_library_course->allow_download ;
            $student_library_course->save();
            $this->dispatch('changed');
        }
    }

    public function manipluateWaterMarkOption($student_library_course_id)
    {
        $student_library_course = LibraryStudent::find($student_library_course_id);
        if ($student_library_course) {
            $student_library_course->force_water_mark = !$student_library_course->force_water_mark ;
            $student_library_course->save();
            $this->dispatch('changed');
        }
    }

    public function manipluateAvailabilityOption($student_library_course_id)
    {
        $student_library_course = LibraryStudent::find($student_library_course_id);
        if ($student_library_course) {
            $student_library_course->is_allowed = !$student_library_course->is_allowed ;
            $student_library_course->save();
            $this->dispatch('changed');
        }
    }



    
    public function render()
    {
        $student_library_courses = LibraryStudent::where('student_id' , $this->student->id )
        ->latest()
        ->get();
        return view('livewire.board.students.library.list-all-courses' , compact('student_library_courses') );
    }
}
