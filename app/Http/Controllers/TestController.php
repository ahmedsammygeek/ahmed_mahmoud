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
use App\Models\Attendance;
use App\Models\CourseStudent;
use DB;
use App\Notifications\WelcomeNotification;
use App\Notifications\NewCourseLessonAddedNotification;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       



        

        $student = Student::with('courses')->find(15);
        $student_course = CourseStudent::where('student_id', 15 )->where('course_id' , 1 )->first();



        $course = Course::with(['sessions' => function($query) use($student_course)  {
            $query
            ->where('group_id' , $student_course->group_id )
            ->whereDate('time_from' , '<=' , Carbon::today() )
            ->leftJoin('attendances' , function($joinQuery){
                $joinQuery
                ->on( 'group_times.id'  , '=' , 'attendances.group_time_id' )
                ->where('attendances.student_id' , '='  , 15 );
            });
            // ->where('student_id' , $student_course->student_id );
            // ->whereHas('attendedStudents', function($query) use($student_course) {
            //     $query->where('student_id' , $student_course->student_id );
            // });
        }])
        ->find(1);

        return $course;

        dd();

        $course_sessions = $course->sessions->pluck('id')->toArray();

        // dd($course_sessions);


        // $sessions = DB::table('group_times')
        // ->whereIn('group_times.id' , $course_sessions )
        // ->leftJoin('attendances' , function($joinQuery){
        //     $joinQuery
        //     ->on('group_times.id'  , '=' , 'attendances.group_time_id' )
        //     ->where('attendances.student_id' , '='  , 15 );
        // })
        // ->get();

        dd($sessions);

        return $course;


        // whereIn('id' , $student->courses()->pluck('course_id')->toArray() )->first();



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
