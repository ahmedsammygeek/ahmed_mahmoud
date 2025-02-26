<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Videos\{StoreVideoRequest , UpdateVideoRequest};
use Alaouy\Youtube\Facades\Youtube;
use App\Models\{LessonVideo , LessonFile , Course , Student , StudentLesson};
use DateInterval;
use Auth;
use Gate;
use Carbon\Carbon;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('list all videos');
        return view('board.videos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('add new video');
        return view('board.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        Gate::authorize('add new video');

        // add video to system
        $videoId = Youtube::parseVidFromURL($request->video_link);
        $video = Youtube::getVideoInfo($videoId);
        $duration = new DateInterval($video->contentDetails->duration);
        $mints = $duration->format('%i');
        $video = new LessonVideo;
        $video->user_id = Auth::id();
        $video->lesson_id = $request->lesson_id;
        $video->lesson_video_link = $request->video_link;
        $video->lesson_video_driver = $request->video_type;
        $video->is_free = $request->filled('is_free') ? 1 : 0;
        $video->video_id = $videoId;
        $video->lesson_mins= $mints;
        $video->allowed_views = 20;
        $video->is_active = $request->filled('is_active') ? 1 : 0;
        $video->setTranslation('title' , 'ar' , $request->title_ar );
        $video->setTranslation('title' , 'en' , $request->title_en );
        $video->setTranslation('content' , 'ar' , $request->description_ar );
        $video->setTranslation('content' , 'en' , $request->description_en );
        $video->save();


        if ($request->hasFile('files')) {
            $lesson_files = [];
            $user_id = Auth::id();
            for ($i=0; $i < count($request->file('files')) ; $i++) { 
                $lesson_files[] = new LessonFile([
                    'lesson_id' => $video->lesson_id,
                    'video_id' => $video->id , 
                    'name' => $request->file('files.'.$i)->getClientOriginalName() , 
                    'file' => basename($request->file('files.'.$i)->store('lesson_files')) , 
                    'user_id' => $user_id  ,
                    'download_allowed_number' => 10  ,  
                ]);
            }
            $video->lesson?->files()->saveMany($lesson_files);
        }

        // now i need to add this video to all students who subscribed to this course unit

        $students = Student::query()
        ->whereHas('courses' , function($query) use ($request) {
            $query->where('course_id' , $request->course_id );
        })
        ->whereHas('units', function($query) use($request) {
            $query->where('unit_id' , $request->unit_id );
        })
        ->get();

        $lesson_students = [];
        $user_id = Auth::id();
        $course = Course::find($request->course_id);
        foreach ($students as $student) {

            $lesson_students[] = [
                'lesson_id' => $video->lesson_id , 
                'user_id' => $user_id, 
                'student_id' => $student->id , 
                'allowed_views' => $course->default_view_number , 
                'remains_views' => $course->default_view_number , 
                'total_views_till_now' => 0  ,
                'video_id' => $video->id ,  
                'created_at' => Carbon::now() , 
                'updated_at' => Carbon::now() , 
            ];
            
        }

        StudentLesson::insert($lesson_students);


        // return redirect(route('board.videos.index'))->with('success' , 'تم الاضافه بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(LessonVideo $video)
    {
        Gate::authorize('show video details');
        return view('board.videos.show' , compact('video') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LessonVideo $video)
    {
        Gate::authorize('edit video details');
        return view('board.videos.edit' , compact('video') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, LessonVideo $video)
    {
        Gate::authorize('edit video details');
        $videoId = Youtube::parseVidFromURL($request->video_link);
        $videoDetails = Youtube::getVideoInfo($videoId);
        $duration = new DateInterval($videoDetails->contentDetails->duration);
        $mints = $duration->format('%i');

        $video->lesson_id = $request->lesson_id;
        $video->lesson_video_link = $request->video_link;
        $video->lesson_video_driver = $request->video_type;
        $video->is_free = $request->filled('is_free') ? 1 : 0;
        $video->video_id = $videoId;
        $video->lesson_mins= $mints;
        $video->allowed_views = 20;
        $video->is_active = $request->filled('is_active') ? 1 : 0;
        $video->setTranslation('title' , 'ar' , $request->title_ar );
        $video->setTranslation('title' , 'en' , $request->title_en );
        $video->setTranslation('content' , 'ar' , $request->description_ar );
        $video->setTranslation('content' , 'en' , $request->description_en );
        $video->save();


        if ($request->hasFile('files')) {
            $lesson_files = [];
            $user_id = Auth::id();
            for ($i=0; $i < count($request->file('files')) ; $i++) { 
                $lesson_files[] = new LessonFile([
                    'lesson_id' => $video->lesson_id,
                    'video_id' => $video->id , 
                    'name' => $request->file('files.'.$i)->getClientOriginalName() , 
                    'file' => basename($request->file('files.'.$i)->store('lesson_files')) , 
                    'user_id' => $user_id  ,
                    'download_allowed_number' => 10  ,  
                ]);
            }
            $video->lesson?->files()->saveMany($lesson_files);
        }


        return redirect(route('board.videos.index'))->with('success' , 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
