<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Course , Unit , Lesson};
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
        $lesson->lesson_mins = mt_rand(4 , 30);
        $lesson->lesson_video_link = $request->video_link;
        $lesson->lesson_video_driver = 'youtube';
        $lesson->is_active = $request->filled('is_active') ? 1 : 0;
        $lesson->is_free = $request->filled('is_free') ? 1 : 0;
        $lesson->save();
        $lesson->video_id = explode('watch?v=', $request->video_link)[1];
        $lesson->save();

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
