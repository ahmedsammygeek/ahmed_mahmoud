<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Videos\{StoreVideoRequest , UpdateVideoRequest};
use Alaouy\Youtube\Facades\Youtube;
use App\Models\LessonVideo;
use DateInterval;
use Auth;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.videos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
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

        return redirect(route('board.videos.index'))->with('success' , 'تم الاضافه بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(LessonVideo $video)
    {
        return view('board.videos.show' , compact('video') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LessonVideo $video)
    {
        return view('board.videos.edit' , compact('video') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, LessonVideo $video)
    {
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