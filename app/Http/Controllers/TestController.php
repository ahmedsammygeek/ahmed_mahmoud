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
use Http;
use Storage;
use Carbon\Carbon;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\Exam;
use App\Models\StudentExam;
use App\Models\StudentExamAnswer;
use App\Models\Attendance;
use App\Models\CourseStudent;
use App\Models\LessonVideo;
use App\Models\Announcement;
use App\Models\Lesson;
// use App\Models\LessonFile;
use DB;
use Mail;
use App\Notifications\WelcomeNotification;
// use App\Notifications\NewCourseLessonAddedNotification;
use App\Mail\MyTestEmail;
use Foodics\OAuth2\Client\Provider\Foodics;

use App\Notifications\NewCourseLessonAddedNotification;
use App\Notifications\NewVideoAddedNotification;
use App\Notifications\NewCourseAddedNotification;
use App\Notifications\PaymentNotification;
use App\Notifications\ExamNotification;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  

        $files = LessonFile::get();


        foreach ($files as $file) {
            
            $file->size = mt_rand(0 , 10000);
            $file->save();
        }


        $student = Student::find(55);

        dd($student->tokens()->delete() );

        // $user = Student::find();
        // dd(auth::user()->tokens);
        // dd(PersonalAccessToken::find(Auth::id(1)));


        // $courses = Course::get();

        // foreach ($courses as $course) {
        //     $unit = $course->units()->first();
        //     $lesson = new Lesson;
        //     $lesson->user_id = 1;
        //     $lesson->unit_id = $unit->id;
        //     $lesson->setTranslation('title' , 'ar' , 'درس جديد مجانى للتجربه');
        //     $lesson->setTranslation('title' , 'en' , 'new lesson for testing');
        //     $lesson->is_active = 1;
        //     $lesson->allowed_views = 40;
        //     $lesson->save();
        //     $video = new LessonVideo;
        //     $video->lesson_id = $lesson->id;
        //     $video->setTranslation('title' , 'ar' , 'فديو جديد للتجربه' );
        //     $video->setTranslation('title' , 'en' , 'new video for test' );
        //     $video->user_id = 1;
        //     $video->allowed_views = 40;
        //     $video->lesson_mins = 26;
        //     $video->lesson_video_driver = 'youtube';
        //     $video->video_id = 'QWcm6dvt8j0';
        //     $video->lesson_video_link = 'https://www.youtube.com/watch?v=QWcm6dvt8j0';
        //     $video->is_free = 1;
        //     $video->is_active = 1;
        //     $video->save();
        // }



        // $students = CourseStudent::whereIn('course_id' , [5])->pluck('student_id')->toArray();




        // foreach ($students as $student) {

        //     $new_view = new StudentLesson;
        //     $new_view->student_id = $student;
        //     $new_view->lesson_id = 37 ;
        //     $new_view->user_id = 1;
        //     $new_view->allowed = 1;
        //     $new_view->total_views_till_now = 0;
        //     $new_view->allowed_views = 40;
        //     $new_view->remains_views = 40;
        //     $new_view->save();
        // }


        // $students = CourseStudent::whereIn('course_id' , [4])->pluck('student_id')->toArray();
        // foreach ($students as $student) {

        //     $new_view = new StudentLesson;
        //     $new_view->student_id = $student;
        //     $new_view->lesson_id = 28 ;
        //     $new_view->user_id = 1;
        //     $new_view->allowed = 1;
        //     $new_view->total_views_till_now = 0;
        //     $new_view->allowed_views = 40;
        //     $new_view->remains_views = 40;
        //     $new_view->save();

        // }


        // $students = CourseStudent::whereIn('course_id' , [3])->pluck('student_id')->toArray();
        // foreach ($students as $student) {

        //     $new_view = new StudentLesson;
        //     $new_view->student_id = $student;
        //     $new_view->lesson_id = 19 ;
        //     $new_view->user_id = 1;
        //     $new_view->allowed = 1;
        //     $new_view->total_views_till_now = 0;
        //     $new_view->allowed_views = 40;
        //     $new_view->remains_views = 40;
        //     $new_view->save();

        // }

        // $students = CourseStudent::whereIn('course_id' , [2])->pluck('student_id')->toArray();
        // foreach ($students as $student) {

        //     $new_view = new StudentLesson;
        //     $new_view->student_id = $student;
        //     $new_view->lesson_id = 10 ;
        //     $new_view->user_id = 1;
        //     $new_view->allowed = 1;
        //     $new_view->total_views_till_now = 0;
        //     $new_view->allowed_views = 40;
        //     $new_view->remains_views = 40;
        //     $new_view->save();

        // }

        // $students = CourseStudent::whereIn('course_id' , [1])->pluck('student_id')->toArray();
        // foreach ($students as $student) {

        //     $new_view = new StudentLesson;
        //     $new_view->student_id = $student;
        //     $new_view->lesson_id = 1 ;
        //     $new_view->user_id = 1;
        //     $new_view->allowed = 1;
        //     $new_view->total_views_till_now = 0;
        //     $new_view->allowed_views = 40;
        //     $new_view->remains_views = 40;
        //     $new_view->save();

        // }



        // $student = Student::find(1);


        // $student->notify(new WelcomeNotification);
        // $student->notify(new NewCourseLessonAddedNotification);
        // $student->notify(new NewVideoAddedNotification);
        // $student->notify(new NewCourseAddedNotification);
        // $student->notify(new PaymentNotification);
        // $student->notify(new ExamNotification);


        // dd($student);


        // dd(Hash::make(90909090));

        dd('ff');


        // $lessons = Lesson::get();

        // foreach ($lessons as $lesson) {

        //     $video1 = new LessonVideo;
        //     $video1->setTranslation('title' , 'ar' , 'الفديو الاول' );
        //     $video1->setTranslation('title' , 'en' , 'first video' );
        //     $video1->user_id = $lesson->user_id;
        //     $video1->lesson_id = $lesson->id;
        //     $video1->is_active = $lesson->is_active;
        //     $video1->allowed_views = $lesson->allowed_views;
        //     $video1->lesson_mins = $lesson->lesson_mins;
        //     $video1->lesson_video_link = $lesson->lesson_video_link;
        //     $video1->lesson_video_driver = $lesson->lesson_video_driver;
        //     $video1->is_free = $lesson->is_free;
        //     $video1->video_id = $lesson->video_id;
        //     $video1->save();



        //     $video2 = new LessonVideo;
        //     $video2->setTranslation('title' , 'ar' , 'الفديو الاول' );
        //     $video2->setTranslation('title' , 'en' , 'first video' );
        //     $video2->user_id = $lesson->user_id;
        //     $video2->lesson_id = $lesson->id;
        //     $video2->is_active = $lesson->is_active;
        //     $video2->allowed_views = $lesson->allowed_views;
        //     $video2->lesson_mins = $lesson->lesson_mins;
        //     $video2->lesson_video_link = $lesson->lesson_video_link;
        //     $video2->lesson_video_driver = $lesson->lesson_video_driver;
        //     $video2->is_free = $lesson->is_free;
        //     $video2->video_id = $lesson->video_id;
        //     $video2->save();
        // }


        // dd('ff');

        // $student = Student::find(36);

        // $announcements = Announcement::with('publishedForStudents')
        // ->whereDoesntHave('views' , function($query) use($student) {
        //     $query->where('student_id' , $student->id );
        // })->where('is_active' , 1 )->get();


        // foreach ($announcements as $announcement) {
        //     dd( $announcement  ,  $announcement->publishedForStudents);
        // }



        $announcements->filter( function($announcement) use($student) {
            if ($announcement->publish_for == 2 ) {

                $students_who_whatched_this_annoncemnt_ids = $announcement->publishedForStudents()->pluck('student_id')->toArray();

                if (!in_array($student->id, $students_who_whatched_this_annoncemnt_ids)) {
                    return $announcement;
                }
            }
        });


        dd($announcements);




        $course = Course::find(2);

        dd($course->lessons()->pluck('lessons.id')->toArray());



        // $code = 'def50200946df722a7b1bb180f83bbaef0732d29829fdb891900e540666061ae90820854a21b9853fa1af94b5880ea044d7b97793420a52388af38d6274ff2940a0c10209fedbee1db6d75581bfad573581f73aaec990bd3811275edbae7e47cc47fca294231cb3a4f0684589a51f1daf60f63f5a295bab30543f9864a73a2f5339b0d77bdb3fde68ca06e0b227e37a82de2a186d6fec72d2eb013923321af0130b1d3156b12a4cdff42a462806e8a47a915fab8c7cef2798ccf6fbbf5e58c4738a5e12abdb118e335941af9eec8d9897bbb547b35c7f3d19e268eca7f26629e9663239e742c30f0297869f7e933c02e642445f21a5c6447e886fde9ab5f1aeca91f1159d0b3c0b96898931e62c3ff2e06086d34f31c5df38ec2ed8d2d007a64c53ce9be3007c658e755379ce802c956ef39f571a1fb6e5bc8a5ab1b6b43ba2bb7c668c989cd39e398059eeeaeeb9bd5f8b9dc4f5c196243a809c817f240cb82f275ccf5138d7f04bc22f75a891f4d0ca157749d8c15bf64c4974be86c1f15550a7e25a741755dc42677c8cc44e7bf240d2dcacafccbb7cc668da1d5e3f50d5fc21a4a81d3954371e0';

        // $response = Http::post('https://api-sandbox.foodics.com/oauth/token' , [

        //     'grant_type' => 'refresh_token' , 
        //     'refresh_token' => $code , 
        //     'client_id' => '9cb311e7-20bc-45d0-9c26-9dc5526b7608' , 
        //     'client_secret' => 'abBMWJFIdMn8RLQEcTWfkB7QFpk1LcS0mTKzQV8F' , 
        //     'redirect_uri' => 'https://console-sandbox.foodics.com' , 
        // ]); 


        // dd($response->json());

        // ['sessions' => function($query) use($student)  {
        //     $query
        //     ->where('group_id' , $student_course->courses()->where('course_id') )
        //     ->whereDate('time_from' , '<=' , Carbon::today() )
        //     ->leftJoin('attendances' , function($joinQuery){
        //         $joinQuery
        //         ->on( 'group_times.id'  , '=' , 'attendances.group_time_id' )
        //         ->where('attendances.student_id' , '='  , 15 );
        //     });
        //     // ->where('student_id' , $student_course->student_id );
        //     // ->whereHas('attendedStudents', function($query) use($student_course) {
        //     //     $query->where('student_id' , $student_course->student_id );
        //     // });
        // }]

        

        // $student = Student::with('courses')->find(15);
        // $student_course = CourseStudent::where('student_id', 15 )->where('course_id' , 1 )->first();



        // $course = Course::with(['sessions' => function($query) use($student_course)  {
        //     $query
        //     ->where('group_id' , $student_course->group_id )
        //     ->whereDate('time_from' , '<=' , Carbon::today() )
        //     ->leftJoin('attendances' , function($joinQuery){
        //         $joinQuery
        //         ->on( 'group_times.id'  , '=' , 'attendances.group_time_id' )
        //         ->where('attendances.student_id' , '='  , 15 );
        //     });
        //     // ->where('student_id' , $student_course->student_id );
        //     // ->whereHas('attendedStudents', function($query) use($student_course) {
        //     //     $query->where('student_id' , $student_course->student_id );
        //     // });
        // }])
        // ->find(1);

        // return $course;

        // dd();

        // $course_sessions = $course->sessions->pluck('id')->toArray();

        // dd($course_sessions);


        // $sessions = DB::table('group_times')
        // ->whereIn('group_times.id' , $course_sessions )
        // ->leftJoin('attendances' , function($joinQuery){
        //     $joinQuery
        //     ->on('group_times.id'  , '=' , 'attendances.group_time_id' )
        //     ->where('attendances.student_id' , '='  , 15 );
        // })
        // ->get();

        // dd($sessions);

        // return $course;


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
