<?php

namespace App\Livewire\Board\Exams;

use Livewire\Component;
use App\Models\{Course , Question , Lesson  , Student};

use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 
use Livewire\WithPagination;
use Carbon\Carbon;
class AddNewExam extends Component
{

    use WithPagination;

    public $course_id;
    public $lesson_id;
    public $selected_qestions = [];
    public $selected_students = [];
    public $can_user_re_exam = 0;
    public $search;
    public $questions_choosing_type = 1 ;
    public $exam_date;
    public $search_students;


    // public function mount()
    // {
    //     $this->exam_date = Carbon::now();
    // }

    // #[Computed]
    // public function questions()
    // {
    //     if ($this->lesson_id) {
    //         return Question::where('course_id' , $this->course_id )->where('lesson_id' , $this->lesson_id )->get();
    //     }
    //     return Question::where('course_id' , $this->course_id )->get();
    // }


    #[Computed]
    public function students()
    {
        return Student::whereHas('courses' , function($query){
            $query->where('course_id' , $this->course_id  );
        })->paginate(10);
    }



    #[Computed]
    public function lessons()
    {
        return Lesson::whereHas('unit' , function($query){
            $query->where('course_id' , $this->course_id );
        })->get();
    }


    #[Computed]
    public function lessons_for_random()
    {
        return Lesson::whereHas('unit' , function($query){
            $query->where('course_id' , $this->course_id );
        })->get();
    }


    public function save()
    {
        $groups = Group::where('course_id' , $this->course_id )->get();

        dd($courses);
        sleep(4);    
    }

    public function render()
    {

        $courses = Course::select('id' , 'title' )->get();
        $questions = Question::when($this->search , function($query){
            $query->where( 'content' ,  'LIKE' , '%'.$this->search.'%' );
        })
        ->when($this->course_id  , function($query){
            $query->where('course_id' , $this->course_id );
        })
        ->when($this->lesson_id  , function($query){
            $query->where('lesson_id' , $this->lesson_id );
        })
        ->paginate(10);
        return view('livewire.board.exams.add-new-exam' , compact('courses' , 'questions' ) );
    }
}
