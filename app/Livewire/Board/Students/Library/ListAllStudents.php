<?php

namespace App\Livewire\Board\Students\Library;

use Livewire\Component;
use App\Models\{Student , Grade  , StudentInstallment , Unit  , Lesson , LessonFileView, StudentUnit , StudentPayment , StudentLesson , CourseStudent ,  Group , EducationalSystem , Course , Teacher };
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Storage;
use Auth;
use Carbon\Carbon;
class ListAllStudents extends Component
{

    use WithPagination  ;
    protected $paginationTheme = 'bootstrap';
    public $rows = 15;
    public $student_type;
    public $selectedCourses;
    public $search;
    public $grade_id;
    public $educational_system_id;
    public $course_id;
    public $teacher_id;
    public $grades;
    public $systems;
    public $is_active = 'all';
    public $selectedStudents = [];

    protected $listeners = ['deleteItem' , 'itemDeleted' => '$refresh' ];  


    #[Validate('required')]
    public $selected_course_id;

    #[Validate('required')]
    public $group_id;

    #[Validate('required')]
    public $purchase_price = 0;

    #[Validate('required')]
    public $paid ;

    #[Validate('required')]
    public $student_units ;

    public $installment_months = 1;
    public $allow = true;


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

    #[Computed]
    public function groups()
    {
        return Group::where('course_id' , $this->selected_course_id )->get();
    }


    #[Computed]
    public function units()
    {
        return Unit::where('course_id' , $this->selected_course_id )->get();
    }





    public function addStudnetsToCourses()
    {

        $user_id = Auth::id();


        foreach ($this->selectedStudents as $selectedStudent) {

            $student = Student::find($selectedStudent);


            $student_course = new CourseStudent;
            $student_course->user_id = Auth::id();
            $student_course->student_id = $selectedStudent;
            $student_course->course_id = $this->selected_course_id;
            $student_course->group_id = $this->group_id;
            $student_course->save();


            $student_units = [];
            foreach ($this->student_units as $student_unit) {
                $student_units[] = new StudentUnit([
                    'student_id' => $selectedStudent , 
                    'user_id' => Auth::id() , 
                    'unit_id' => $student_unit , 
                    'is_allowed' => 1 , 
                ]);
            }

            $student->units()->saveMany($student_units);

            $course = Course::find($this->selected_course_id );
            $course_lessons = $course->lessons()->whereIn('lessons.unit_id' , $this->student_units )->pluck('lessons.id')->toArray();
            $student_lessons = [];
            foreach ($course_lessons as $course_lesson) {
                $student_lessons[] = new StudentLesson([
                    'lesson_id' => $course_lesson , 
                    'user_id' => $user_id, 
                    'student_id' => $selectedStudent , 
                    'allowed_views' => $course->default_view_number , 
                    'remains_views' => $course->default_view_number , 
                    'total_views_till_now' => 0  ,
                ]);
            }
            $student->lessons()->saveMany($student_lessons);
            $lesson_student_files = [];
            foreach ($course_lessons as $course_lesson) {
                $lesson = Lesson::find($course_lesson);
                foreach ($lesson->files as $lesson_file) {
                    $lesson_student_files[] = [
                        'student_id' => $selectedStudent , 
                        'lesson_file_id' => $lesson_file->id , 
                        'user_id' => $user_id, 
                        'total_views_till_now' => 0  ,
                        'total_downloads_till_now' => 0 , 
                        'allowed_views_number' => 20 , 
                        'allowed_downloads_number' => 20 , 
                        'force_water_mark' => 1 , 
                        'water_mark_text' => 't3leem' , 
                        'is_allowed' => 1 , 
                        'created_at' => Carbon::now() , 
                        'updated_at' => Carbon::now() , 
                    ];
                }  
            }




            LessonFileView::insert($lesson_student_files);

            $this->dispatch('studentAddedToCourse');
        }

    }

    public function mount() {

        $this->grades = Grade::select('name', 'id' )->get();
        $this->systems = EducationalSystem::select('name', 'id' )->get();
        $this->selectedCourses = Course::select('id' , 'title')->get();
    }

    #[Computed]
    public function courses()
    {
        return Course::when($this->grade_id , function($query){
            $query->where('grade_id' , $this->grade_id );
        })
        ->when($this->teacher_id , function($query){
            $query->where('teacher_id' , $this->teacher_id );

        })
        ->select('title' , 'id')->get();
    }

    #[Computed]
    public function teachers()
    {
        return Teacher::select('name' , 'id')->get();
    }

    public function render()
    {
        $students = Student::query()
        ->with(['grade' , 'educationalSystem' ])
        ->when($this->search , function($query){
            $query
            ->where('name' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('mobile' ,  'LIKE' , '%'.$this->search.'%'  )
            ->orWhere('guardian_mobile' ,  'LIKE' , '%'.$this->search.'%' );
        })
        ->when($this->grade_id , function($query){
            $query->where('grade_id' , $this->grade_id );
        })
        ->when($this->educational_system_id , function($query){
            $query->where('educational_system_id' , $this->educational_system_id );
        })
        ->when($this->course_id , function($query){
            $query->whereHas('courses' , function($query){
                $query->where('course_id' , $this->course_id );
            });
        })
        ->when($this->teacher_id , function($query){
            $query->whereHas('courses' , function($query){
                $query->where('teacher_id' , $this->teacher_id );
            });
        })
        ->when($this->student_type, function($query){
            $query->where('student_type' , $this->student_type);
        })
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.students.library.list-all-students' , compact('students') );
    }
}
