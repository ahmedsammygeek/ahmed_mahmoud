<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Arr;
use Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentLesson;
use App\Models\CourseUnitLesson;
use App\Models\LessonFile;
use App\Jobs\UploadVidoeLessontoYoutubeJob;
// use Youtube;
// use Alaouy\Youtube\Facades\Youtube;
 use Alaouy\Youtube\Facades\Youtube;
use Hash;
use Storage;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       


        $pdf_path = 'sample.pdf';
       

        $lessons = CourseUnitLesson::get();

        foreach ($lessons as $lesson) {
            $file = new LessonFile;
            $file->course_unit_lesson_id = $lesson->id;
            $file->user_id = 1;
            $file->download_allowed_number = 20;
            $file->file = 'sample.pdf';
            $file->save();
        }


       
        dd('done');
        // dd($videoId);


        // dd(Auth::id());
        $course = Course::find(3);
        // dd($course->lessons()->pluck('course_unit_lessons.id')->toArray());


        foreach ($course->lessons()->pluck('course_unit_lessons.id')->toArray() as $lesson_id) {
            $lesson = new StudentLesson;
            $lesson->user_id = 1;
            $lesson->course_unit_lesson_id = $lesson_id;
            $lesson->student_id = 15;
            $lesson->allowed = 1;
            $lesson->total_views_till_now = 50;
            $lesson->allowed_views = 20;
            $lesson->remains_views = 18; 
            $lesson->save();
        }



        // $user = User::find(1);
        // Auth::login($user);

        dd(Hash::make(90909090));

        $fullPathToVideo = public_path().'/Sunset_Swinging04_MP4_HDV_1080p25__TanuriX_Stock_Footage_NS_720p_5000br.mp4';

        $video = Youtube::upload($fullPathToVideo, [
            'title'       => 'ماده الفيزياء الوحده الاول',
            'description' => 'مراجع عامله على ماده الفزيا للصف الثانى الثانوى',
            'tags'        => ['مراجعه', 'فيزياء'],
            'category_id' => 10
        ] , 'unlisted' );

        return $video->getVideoId();

        // video_for_test.mp4


        // dispatch(new UploadVidoeLessontoYoutubeJob);


        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
