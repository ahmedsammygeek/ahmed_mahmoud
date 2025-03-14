<?php

namespace App\Livewire\Board\Courses;

use Livewire\Component;
use App\Models\CourseStudent;
use App\Models\Student;
use App\Models\Unit;
use Auth;
use Livewire\WithPagination;
class ListAllCourseStudents extends Component
{
    use WithPagination;
    public $course;
    public $unit_id;

    protected $listeners = ['removeStudentFromCourse' , 'itemDeleted' => '$refresh' ];  


    public function updatedRows()
    {
        $this->resetPage();
    }



    public function removeStudentFromCourse ($itemId) {

        $courseStudent = CourseStudent::where('student_id' , $itemId )
        ->where('course_id' , $this->course->id )
        ->latest()
        ->first();
        if ($courseStudent) {
            $courseStudent->deleted_by = Auth::id();
            $courseStudent->save();
            $courseStudent->delete();
            $this->dispatch('studentDeletedFromCourse');
        }
    }



    public function render()
    {
        $students = Student::with('faculty')
        ->whereHas('courses' , function($query){
            $query->where('course_id' , $this->course->id );
        })
        ->when($this->unit_id , function($query){
            $query->whereHas('units' , function($query){
                $query->where('unit_id' , $this->unit_id );
            });
        })
        ->latest()->paginate(1555);

        $units = Unit::where('course_id' , $this->course->id )->get();

        return view('livewire.board.courses.list-all-course-students' , compact('students' , 'units'));
    }
}