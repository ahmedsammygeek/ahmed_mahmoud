<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Course , Unit , Lesson , LessonVideo , LessonFile , StudentLesson , CourseStudent};

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

        $lesson = new Lesson;
        $lesson->setTranslation('title' , 'ar' ,   $request->title_ar );
        $lesson->setTranslation('title' , 'en' ,   $request->title_en );
        $lesson->setTranslation('content' , 'ar' ,   $request->description_ar );
        $lesson->setTranslation('content' , 'en' ,   $request->description_en );
        $lesson->user_id = Auth::id();
        $lesson->unit_id = $unit->id;
        $lesson->allowed_views = $request->allowed_views;
        $lesson->is_active = $request->filled('is_active') ? 1 : 0;
        $lesson->is_free = $request->filled('is_free') ? 1 : 0;
        $lesson->save();

        $course_lessons = $course->lessons()->pluck('lessons.id')->toArray();
        $user_id = Auth::id();

        $course_students = CourseStudent::where('course_id' , $course->id )->pluck('student_id')->toArray();
        foreach ($course_students as $course_student) {
            foreach ($course_lessons as $course_lesson) {
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

        if ($request->hasFile('files')) {
            $lesson_files = [];
            $user_id = Auth::id();
            for ($i=0; $i < count($request->file('files')) ; $i++) { 
                $lesson_files[] = new LessonFile([
                    'lesson_id' => $lesson->id,
                    'name' => $request->file('files.'.$i)->getClientOriginalName() , 
                    'file' => basename($request->file('files.'.$i)->store('lesson_files')) , 
                    'user_id' => $user_id  ,
                    'download_allowed_number' => 10  ,  
                ]);
            }
            $lesson->files()->saveMany($lesson_files);
        }


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
    public function edit(Course $course , Unit $unit ,  Lesson $lesson)
    {
        return view('board.lessons.edit' , compact('lesson'  , 'unit' , 'course' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Course $course , Unit $unit ,  Lesson $lesson)
    {
        $lesson->setTranslation('title' , 'ar' ,   $request->title_ar );
        $lesson->setTranslation('title' , 'en' ,   $request->title_en );
        $lesson->setTranslation('content' , 'ar' ,   $request->description_ar );
        $lesson->setTranslation('content' , 'en' ,   $request->description_en );
        $lesson->allowed_views = $request->allowed_views;
        $lesson->is_active = $request->filled('is_active') ? 1 : 0;
        $lesson->is_free = $request->filled('is_free') ? 1 : 0;
        $lesson->save();


        if ($request->hasFile('files')) {
            $lesson_files = [];
            $user_id = Auth::id();
            for ($i=0; $i < count($request->file('files')) ; $i++) { 
                $lesson_files[] = new LessonFile([
                    'lesson_id' => $lesson->id,
                    'name' => $request->file('files.'.$i)->getClientOriginalName() , 
                    'file' => basename($request->file('files.'.$i)->store('lesson_files')) , 
                    'user_id' => $user_id  ,
                    'download_allowed_number' => 10  ,  
                ]);
            }
            $lesson->files()->saveMany($lesson_files);
        }

        return redirect(route('board.courses.units.lessons.index'  ,  ['course' => $course  , 'unit' => $unit ] ))->with('success' , trans('board.updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
