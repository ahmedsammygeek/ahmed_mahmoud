<?php

namespace App\Livewire\Board\Students\Library;

use Livewire\Component;
use App\Models\{Student , Grade , LibraryStudent, LessonFile  , LibraryStudentUnit , StudentInstallment , Unit  , Lesson , LessonFileView, StudentUnit , StudentPayment , StudentLesson , CourseStudent ,  Group , EducationalSystem , Course , Teacher };
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
    public $selectAll = false ;

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
    public function courses()
    {
        return Course::when($this->teacher_id , function($query){
            $query->where('teacher_id' , $this->teacher_id );

        })
        ->select('title' , 'id')->get();
    }

    #[Computed]
    public function teachers()
    {
        return Teacher::select('name' , 'id')->get();
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

    public function selectAllStudents() {

        $this->selectAll = !$this->selectAll;
        if ($this->selectAll) {
            $this->selectedStudents =  $this->generateQuery()->pluck('id')->toArray()  ;
        } else {
            $this->selectedStudents =  []  ;
        }
    }



    public function addStudnetsToCourses()
    {
        $user_id = Auth::id();
        $default_course_library_options = get_default_course_library_options($this->selected_course_id);
        foreach ($this->selectedStudents as $selectedStudent) {


            $dose_students_has_this_course = LibraryStudent::where('student_id' , $selectedStudent )
            ->where('course_id', $this->selected_course_id )->first();
            if (!$dose_students_has_this_course) {

                $student_course = new LibraryStudent;
                $student_course->user_id = Auth::id();
                $student_course->student_id = $selectedStudent;
                $student_course->course_id = $this->selected_course_id;
                $student_course->is_allowed = 1;
                $student_course->save();
                $student_units = [];
                foreach ($this->student_units as $student_unit) {

                    $student_units[] = new LibraryStudentUnit([
                        'student_id' => $selectedStudent , 
                        'user_id' => Auth::id() , 
                        'unit_id' => $student_unit , 
                        'is_allowed' => 1 , 
                        'course_id' => $this->selected_course_id,
                    ]);
                }
                $student = Student::where('id' , $selectedStudent )->first();
                $student->libraryUnits()->saveMany($student_units);
                $course = Course::find($this->selected_course_id);
                $lessons = Lesson::whereHas('unit' , function($query)  {
                    $query->whereIn('unit_id' , $this->student_units );
                })->pluck('id')->toArray();

                $files = LessonFile::whereIn('lesson_id' , $lessons )->get();

                $student_files = [];
                foreach ($files as $file) {
                    $student_files[] = [
                        'student_id' => $selectedStudent , 
                        'lesson_file_id' => $file->id , 
                        'total_views_till_now' => 0 , 
                        'total_downloads_till_now' => 0 , 
                        'allowed_views_number' => 50 , 
                        'allowed_downloads_number' => 50 , 
                        'force_water_mark' => $default_course_library_options['force_water_mark'] , 
                        'allow_download' => $default_course_library_options['allow_download'] , 
                        'water_mark_text' => 't3leem' , 
                        'user_id' => $user_id , 
                        'created_at' => Carbon::now() , 
                        'updated_at' => Carbon::now() , 
                    ];
                }
                LessonFileView::insert($student_files);
            }         
        }

        $this->dispatch('studentAddedToCourse');

    }

    public function mount() {

        $this->grades = Grade::select('name', 'id' )->get();
        $this->systems = EducationalSystem::select('name', 'id' )->get();
        $this->selectedCourses = Course::select('id' , 'title')->get();
    }

    public function generateQuery()
    {
        return Student::query()
        ->with(['grade' , 'educationalSystem' ])
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
            $query->whereHas('courses' , function($query){
                $query->whereHas('course' , function($query){
                    $query->where('teacher_id' , $this->teacher_id );
                });
            });
        });
    }


    public function render()
    {
        $students = $this->generateQuery()
        ->latest()
        ->paginate($this->rows);

        return view('livewire.board.students.library.list-all-students' , compact('students') );
    }
}
