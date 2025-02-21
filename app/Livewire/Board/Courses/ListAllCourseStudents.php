<?php

namespace App\Livewire\Board\Courses;

use Livewire\Component;
use App\Models\CourseStudent;
use App\Models\Student;
use Auth;
use Livewire\WithPagination;
class ListAllCourseStudents extends Component
{
    use WithPagination;
    public $course;

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
        $students = Student::with('faculty')->whereHas('courses' , function($query){
            $query->where('course_id' , $this->course->id );
        })->latest()->paginate(30);
        return view('livewire.board.courses.list-all-course-students' , compact('students'));
    }
}
