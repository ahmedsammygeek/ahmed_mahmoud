<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Library\{StoreFileRequest , UpdateFileRequest};
use App\Models\{ Lesson ,  LessonVideo , LessonFile , Course , Student , CourseStudent , LessonFileView};
use App\Notifications\NewFileAddedNotification;
use Auth;
use Carbon\Carbon;
use Notification;
use Storage;
class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.library.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.library.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        $lesson = Lesson::find($request->lesson_id);
        $video = LessonVideo::find($request->video_id);
        $students = Student::find($request->students);

        $lesson_files = [];
        $file_students = [];

        $user_id = Auth::id();
        for ($i=0; $i < count($request->file('files')) ; $i++) { 
            $file_path = basename($request->file('files.'.$i)->store('lesson_files'));
            $lesson_files[] = new LessonFile([
                'video_id' => $video ? $request->video_id : null , 
                'lesson_id' => $lesson->id,
                'name' => $request->file('files.'.$i)->getClientOriginalName() , 
                'file' =>  $file_path   , 
                'user_id' => $user_id  ,
                'size' =>  Storage::size('lesson_files/'.$file_path)  , 
                'download_allowed_number' => $request->download_allowed_number   ,  
            ]);
        }

        $saved_lesson_files =  $lesson->files()->saveMany($lesson_files);


        foreach ($saved_lesson_files as $saved_lesson_file) {
            foreach ($students as $student) {
                $file_students[] = [
                    'student_id' => $student->id , 
                    'lesson_file_id' => $saved_lesson_file->id , 
                    'total_views_till_now' => 0 , 
                    'total_downloads_till_now' => 0 , 
                    'allowed_views_number' => $request->allowed_views_number , 
                    'allowed_downloads_number' => $request->download_allowed_number , 
                    'force_water_mark' => $request->filled('force_water_mark') ? 1 : 0 , 
                    'water_mark_text' => 't3leem' , 
                    'user_id' => $user_id , 
                    'created_at' => Carbon::now() , 
                    'updated_at' => Carbon::now() , 
                ];
            }
            Notification::send($students , new NewFileAddedNotification($saved_lesson_file) );
        }
        LessonFileView::insert($file_students);



        return redirect(route('board.library.index'))->with('success' , trans('library.file added successfully') );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LessonFile $library)
    {

        return view('board.library.edit' , compact('library'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, LessonFile $library)
    {
        $library->lesson_id = $request->lesson_id;
        $library->video_id = $request->video_id;
        $library->save();

        return redirect(route('board.library.index'))->with('success' , trans('library.file updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function assgin_students()
    {
        return view('board.library.students');
    }
}
