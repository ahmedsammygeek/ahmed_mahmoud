<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Course , Unit , Lesson , LessonVideo , StudentLesson , CourseStudent};

use App\Http\Requests\Board\Courses\Units\Lessons\{StoreLessonRequest , UpdateLessonRequest};
use Auth;
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course  , Unit $unit)
    {
        return view('board.lessons.index' , compact('unit' , 'course' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course  , Unit $unit)
    {
        return view('board.lessons.create' , compact('course' , 'unit' ) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request , Course $course  , Unit $unit )
    {
        // dd('gg');
        $lesson = new Lesson;
        $lesson->setTranslation('title' , 'ar' ,   $request->title_ar );
        $lesson->setTranslation('title' , 'en' ,   $request->title_en );
        $lesson->setTranslation('content' , 'ar' ,   $request->description_ar );
        $lesson->setTranslation('content' , 'en' ,   $request->description_en );
        $lesson->user_id = Auth::id();
        $lesson->unit_id = $unit->id;
        $lesson->allowed_views = $request->allowed_views;
        $lesson->is_active = $request->filled('is_active') ? 1 : 0;

        $lesson->save();



        $video = new LessonVideo;
        $video->setTranslation('title' , 'ar' ,   $request->title_ar );
        $video->setTranslation('title' , 'en' ,   $request->title_en );
        $video->setTranslation('content' , 'ar' ,   $request->description_ar );
        $video->setTranslation('content' , 'en' ,   $request->description_en );
        $video->lesson_id  = $lesson->id;
        $video->lesson_mins = 26;
        $video->user_id = Auth::id();
        $video->lesson_video_link = $request->video_link;
        $video->lesson_video_driver = 'youtube';
        $video->is_active = $request->filled('is_active') ? 1 : 0;
        $video->is_free = $request->filled('is_free') ? 1 : 0;
        $video->allowed_views = $request->allowed_views;
        $video->video_id = explode('watch?v=', $request->video_link)[1];
        $video->save();


        $course_lessons = $course->lessons()->pluck('lessons.id')->toArray();
        $user_id = Auth::id();

        $course_students = CourseStudent::where('course_id' , $course->id )->pluck('student_id')->toArray();
        foreach ($course_students as $course_student) {
            foreach ($course_lessons as $course_lesson) {
                // dd($course_lesson);
                $student_lesson = new  StudentLesson;
                $student_lesson->lesson_id = $course_lesson ; 
                $student_lesson->user_id = $user_id ; 
                $student_lesson->student_id = $course_student ; 
                $student_lesson->allowed_views = $course->default_view_number ; 
                $student_lesson->remains_views = $course->default_view_number ; 
                $student_lesson->total_views_till_now = 0 ; 
                $student_lesson->save();
            }
        }
        // $this->student->lessons()->saveMany($student_lessons);



        // now we need to check if any one has this course or not



        return redirect(route('board.courses.units.lessons.index'  ,  ['course' => $course  , 'unit' => $unit ] ))->with('success' , trans('board.added successfully') );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course , Unit $unit ,  Lesson $lesson)
    {
        return view('board.lessons.show' , compact('lesson' , 'unit' , 'course' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
