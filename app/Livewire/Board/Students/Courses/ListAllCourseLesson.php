<?php

namespace App\Livewire\Board\Students\Courses;

use Livewire\Component;
use App\Models\{StudentLesson , Unit , StudentUnit , LessonVideo};
class ListAllCourseLesson extends Component
{
    public $student;
    public $course;
    public $has_all_lessons_videos;
    public $selected_unit_id;
    public $dose_this_student_subscribed_to_selected_unit;


    public function updated($name, $value)
    {
        if ($name == 'selected_unit_id' ) {
            // dd($name , $value);
            $check = StudentUnit::where('student_id' , $this->student->id )
            ->where('unit_id' , $this->selected_unit_id )->first();
            if ($check) {
                $dose_this_student_subscribed_to_selected_unit = true;
                $get_unit_lessons_videos_count = LessonVideo::whereHas('lesson' ,function($query) {
                    $query->where('unit_id' , $this->selected_unit_id );
                })->count();

                $get_unit_lessons_videos_added_to_student_count = StudentLesson::where('student_id' , $this->student->id )->whereHas('lesson' ,function($query) {
                    $query->where('unit_id' , $this->selected_unit_id );
                })->count();

                // dd($get_unit_lessons_videos_count , $get_unit_lessons_videos_added_to_student_count , $dose_this_student_subscribed_to_selected_unit);


                if ($get_unit_lessons_videos_count  ==  $get_unit_lessons_videos_added_to_student_count) {
                    $this->has_all_lessons_videos = true;
                } else {
                    $this->has_all_lessons_videos = false;
                }
            } else {
                $dose_this_student_subscribed_to_selected_unit = false;
            }
        }
    }



    public function fixStudentVideos()
    {
       dd('ffff');
    }

    public function render()
    {
        $student_lessons = StudentLesson::with(['lesson' , 'user' , 'video' ])
        ->when($this->selected_unit_id , function($query) {
            $query->whereHas('lesson' , function($query) {
                $query->where('unit_id' , $this->selected_unit_id );
            });
        })
        ->where('student_id' , $this->student->id )
        ->whereIn('lesson_id' , $this->course->lessons()->pluck('lessons.id')->toArray() )
        ->get();

        $units = Unit::where('course_id'  , $this->course->id )->get();
        $student_course_units = StudentUnit::where('student_id' , $this->student->id )
        ->whereHas('unit' , function($query){
            $query->where('course_id' , $this->course->id );
        })->pluck('unit_id')->toArray();
        return view('livewire.board.students.courses.list-all-course-lesson' , compact('student_lessons' , 'units' , 'student_course_units') );
    }
}
