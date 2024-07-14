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
use Carbon\Carbon;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\Exam;
use App\Models\StudentExam;
use App\Models\StudentExamAnswer;
use App\Notifications\WelcomeNotification;
use App\Notifications\NewCourseLessonAddedNotification;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
        $n = 15;


        foreach (range(1, 15) as $number) {
    if(0 !== $number % 3 && 0 !== $number % 5) {
        echo $number.'<br>';
        continue;
    }

    if(0 === $number % 3) {
        echo 'Fizz';
    }

    if(0 === $number % 5) {
        echo 'Buzz';
    }

    echo '<br>';
}


        // for ($i=1; $i <= $n ; $i++) { 
        //     $output = $i ;
            
        //     if ( (($i % 3) == 0 ) && (($i % 5) == 0 ) ) {
        //         $output = 'FizzBuzz';
        //     } else {
        //         if ($i%3 == 0 ) {
        //            $output = 'Fizz';
        //         } elseif ($i%5 == 0 ) {

        //             $output = 'Buzz';
        //         } 
        //     }
        //     echo $output.'<br>';
        // }





        // $student = Student::find(26);

        // $student->notify(new WelcomeNotification);
        // $student->notify(new NewCourseLessonAddedNotification);

        // dd($student);

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
