<?php

namespace App\Livewire\Board\Students;

use Livewire\Component;
use App\Models\{Student , Grade , EducationalSystem , CourseStudent , Course , Teacher , Unit, Lesson , LessonVideo , StudentLesson   };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
use Auth;
use Livewire\Attributes\Url;
class ListAllStudents extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;
    public $student_type;
    #[Url]
    public $search;
    #[Url]
    public $course_id;
    #[Url]
    public $teacher_id;
    public $is_active = 'all';
    #[Url]
    public $selectAll = false ;
    #[Url]
    public $selectedStudents = [];
    #[Url]
    public $unit_id;
    #[Url]
    public $lesson_id;
    public $selectedVideos = [];
    public $selectAllVideos = false ;
    public $allowed_views;
    public $selected_course_to_be_removed_id;
    public $selected_course_to_be_allowed_id;
    public $selected_course_to_be_disallowed_id;
    public $modal_courses;
    public $disable_reason;

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    public function mount()
    {
        $this->modal_courses = Course::select('title' , 'id')->get();
    }

    public function updated()
    {
        $this->resetPage();
    }


    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedStudents =  $this->generateQuery()->pluck('id')->toArray()  ;
        } else {
            $this->selectedStudents =  []  ;
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


    public function SelectAllVideosddddd()
    {
        $this->selectAllVideos = !$this->selectAllVideos;
        if ($this->selectAllVideos) {
            $this->selectedVideos = LessonVideo::whereIn('lesson_id' , $this->lessons()->pluck('id')->toArray() )->pluck('id')->toArray();
        } else {
            $this->selectedVideos = [];
        }
    }





    public function resetFilters()
    {
        $this->search = null;
        $this->course_id = null;
        $this->teacher_id = null;
    }


    public function loginFromAnotherDevice()
    {
        foreach ($this->selectedStudents as $selectedStudent) {
            $student = Student::find($selectedStudent);
            if ($student) {
                $student->mobile_serial_number = null;
                $student->unique_device_id = null;
                $student->save();
                $student->tokens()->delete();
                $student->tokens()->delete();
            }
        }
        $this->selectedStudents = [];
        $this->selectAll = false;
        $this->dispatch('devicesRemoved');
    }


    public function IncreaseViews()
    {
        $students = StudentLesson::whereIn('student_id' ,  $this->selectedStudents )
        ->whereIn('video_id' ,  $this->selectedVideos )
        ->increment( 'allowed_views' , $this->allowed_views );
        $students = StudentLesson::whereIn('student_id' ,  $this->selectedStudents )
        ->whereIn('video_id' ,  $this->selectedVideos )
        ->increment( 'remains_views' , $this->allowed_views );
        $this->dispatch('viewsUpdateSuccessfully');
    }

    public function ResetViews()
    {

        $default_course_views = get_default_course_views($this->course_id);
        $this->selectedVideos = LessonVideo::whereIn('lesson_id' , $this->lessons()->pluck('id')->toArray() )->pluck('id')->toArray();
        $students = StudentLesson::whereIn('student_id' ,  $this->selectedStudents )
        ->whereIn('video_id' ,  $this->selectedVideos )
        ->update( ['allowed_views' => $default_course_views] );
        $students = StudentLesson::whereIn('student_id' ,  $this->selectedStudents )
        ->whereIn('video_id' ,  $this->selectedVideos )
        ->update( ['remains_views' => $default_course_views ]);

        $this->course_id = null;
        $this->unit_id = null;
        $this->selectAllVideos = [];
        $this->selectedVideos = [];
        $this->selectedStudents = [];
        $this->dispatch('viewsUpdateSuccessfully');
    }


    public function ZeroViews()
    {
        $default_course_views = get_default_course_views($this->course_id);
        $this->selectedVideos = LessonVideo::whereIn('lesson_id' , $this->lessons()->pluck('id')->toArray() )->pluck('id')->toArray();
        $students = StudentLesson::whereIn('student_id' ,  $this->selectedStudents )
        ->whereIn('video_id' ,  $this->selectedVideos )
        ->update( ['allowed_views' => 0 ] );
        $students = StudentLesson::whereIn('student_id' ,  $this->selectedStudents )
        ->whereIn('video_id' ,  $this->selectedVideos )
        ->update( ['remains_views' => 0  ]);

        $this->course_id = null;
        $this->unit_id = null;
        $this->selectAllVideos = [];
        $this->selectedVideos = [];
        $this->selectedStudents = [];
        $this->dispatch('viewsUpdateSuccessfully');
    }


    public function removeStudentsFromCourses() {
        $user_id = Auth::id();
        foreach ($this->selectedStudents as $selectedStudent) {
            $course_student = CourseStudent::where('student_id' , $selectedStudent )->where('course_id' , $this->selected_course_to_be_removed_id )->first();
            if ($course_student) {
                $course_student->deleted_by = $user_id;
                $course_student->save();
                $course_student->delete();
            }
        }
        $this->course_id = null;
        $this->unit_id = null;
        $this->selectAllVideos = [];
        $this->selectedVideos = [];
        $this->selectedStudents = [];
        $this->selectAll = false;
        $this->selected_course_to_be_removed_id = null;
        $this->dispatch('removed');

    }


    public function allowCourses()
    {

        $res = CourseStudent::whereIn('student_id' , $this->selectedStudents )
        ->where('course_id' , $this->selected_course_to_be_allowed_id )
        ->update([
            'allow' => 1 , 
            'disable_reason' => null ,
        ]);
        $this->selected_course_to_be_allowed_id = null;
        $this->course_id = null;
        $this->unit_id = null;
        $this->selectAllVideos = [];
        $this->selectedVideos = [];
        $this->selectedStudents = [];
        $this->selectAll = false;
        $this->dispatch('courseAllowededToStudents');
    }  

    public function disableCourses()
    {

        $res = CourseStudent::whereIn('student_id' , $this->selectedStudents )
        ->where('course_id' , $this->selected_course_to_be_disallowed_id )
        ->update([
            'allow' => 0 , 
            'disable_reason' => $this->disable_reason ,
        ]);

        $this->selected_course_to_be_disallowed_id = null;
        $this->selected_course_to_be_allowed_id = null;
        $this->course_id = null;
        $this->unit_id = null;
        $this->selectAllVideos = [];
        $this->selectedVideos = [];
        $this->selectedStudents = [];
        $this->selectAll = false;
        $this->dispatch('courseDisabldToStudents');
    }


    public function generateQuery()
    {
        return Student::query()
        ->when($this->search , function($query){
            $query
            ->where('name' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('mobile' ,  'LIKE' , '%'.$this->search.'%'  )
            ->orWhere('guardian_mobile' ,  'LIKE' , '%'.$this->search.'%' );
        })
        ->when($this->course_id , function($query){
            $query->whereHas('courses' , function($query){
                $query->where('course_id' , $this->course_id );
            });
        })
        ->when($this->teacher_id , function($query){
            $query->whereHas('courses.course' , function($query){
                $query->where('teacher_id' , $this->teacher_id );
            });
        })
        ->when($this->student_type, function($query){
            $query->where('student_type' , $this->student_type);
        });
    }

    public function render()
    {
        $students = $this->generateQuery()
        ->latest()
        ->paginate($this->rows);
        return view('livewire.board.students.list-all-students' , compact('students') );
    }
}
