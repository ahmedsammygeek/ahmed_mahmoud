<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Student\V1\Auth\RegisterController;
use App\Http\Controllers\Api\Student\V1\Auth\LoginController;
use App\Http\Controllers\Api\Student\V1\Auth\LogoutController;
use App\Http\Controllers\Api\Student\V1\ProfileController;
use App\Http\Controllers\Api\Student\V1\PhoneVerificationController;
use App\Http\Controllers\Api\Student\V1\ForgetPasswordController;
use App\Http\Controllers\Api\Student\V1\HomeController;
use App\Http\Controllers\Api\Student\V1\SearchController;
use App\Http\Controllers\Api\Student\V1\TeacherController;
use App\Http\Controllers\Api\Student\V1\CourseController;
use App\Http\Controllers\Api\Student\V1\GradeController;
use App\Http\Controllers\Api\Student\V1\EducationalSystemController;
use App\Http\Controllers\Api\Student\V1\LessonController;
use App\Http\Controllers\Api\Student\V1\ExamController;
use App\Http\Controllers\Api\Student\V1\NotificationController;
use App\Http\Controllers\Api\Student\V1\SplashController;
use App\Http\Controllers\Api\Student\V1\AboutController;
use App\Http\Controllers\Api\Student\V1\TermController;
use App\Http\Controllers\Api\Student\V1\PrivacyController;
use App\Http\Controllers\Api\Student\V1\FAQController;
use App\Http\Controllers\Api\Student\V1\FeebackController;
use App\Http\Controllers\Api\Student\V1\StudentCourseController;
use App\Http\Controllers\Api\Student\V1\SettingController;
use App\Http\Controllers\Api\Student\V1\AttendanceController;
use App\Http\Controllers\Api\Student\V1\PaymentController;

Route::group(['prefix' => 'student/v1'], function() {

    Route::post('/register' , [RegisterController::class , 'index'] );    
    Route::post('/login' , [LoginController::class , 'index'] );   
    Route::post('forget-password' , [ForgetPasswordController::class , 'index'] );
    Route::post('forget-password/verify' , [ForgetPasswordController::class , 'verify'] );
    Route::post('forget-password/change-password' , [ForgetPasswordController::class , 'change_password']);


    Route::get('educational_systems' , [EducationalSystemController::class , 'index'] );
    Route::get('grades' , [GradeController::class , 'index'] );
    Route::get('/splashes' , [SplashController::class , 'index'] );
    Route::get('/about' , [AboutController::class , 'index'] );
    Route::get('/terms' , [TermController::class , 'index'] );
    Route::get('/privacy' , [PrivacyController::class , 'index'] );
    Route::get('/faq' , [FAQController::class , 'index'] );
    Route::get('/settings' , [SettingController::class , 'index'] );
    Route::get('/home' , [HomeController::class , 'index'] );
    Route::get('/search' , [SearchController::class , 'index'] ); 
    Route::get('/teachers' , [TeacherController::class , 'index'] ); 
    Route::get('/teachers/{teacher}' , [TeacherController::class , 'show'] ); 
    Route::get('/courses' , [CourseController::class , 'index'] );
    Route::get('/courses/{course}' , [CourseController::class , 'show'] );
    Route::get('/courses/{course}/lessons/{lesson}' , [LessonController::class , 'show'] );


    Route::group(['middleware' => ['auth:student']  ], function() {
        Route::post('/verification' , [PhoneVerificationController::class , 'index'] );
        Route::post('/verification/code/send' , [PhoneVerificationController::class , 'send_code'] );
        Route::get('/profile' , [ProfileController::class , 'index'] ); 
        Route::group(['middleware' => 'phone_verification'  ], function() {
            Route::post('/logout' , [LogoutController::class , 'index'] ); 
            Route::patch('/profile' , [ProfileController::class , 'update'] ); 
            Route::delete('/profile' , [ProfileController::class , 'delete'] ); 
            Route::post('/courses/{course}/lessons/{lesson}/watched' , [LessonController::class , 'watched'] ); 
            Route::get('exams/{exam}' , [ExamController::class , 'show'] );
            Route::get('exams/{exam}/result' , [ExamController::class , 'result'] );
            Route::post('exams/{exam}/answer' , [ExamController::class , 'answer'] );
            Route::get('notifications' , [NotificationController::class , 'index'] );
            Route::post('notifications' , [NotificationController::class , 'read'] );
            Route::post('feedback' , [FeebackController::class , 'store'] );
            Route::get('/my_courses/ongoing' , [StudentCourseController::class , 'on_going'] );
            Route::get('/my_courses/completed' , [StudentCourseController::class , 'completed'] );
            Route::get('attendance' , [AttendanceController::class , 'index'] );
            Route::get('payments'  , [PaymentController::class , 'index']);

            Route::post('files/{lesson_file}/downloaded' , [LessonController::class , 'downloaded'] );
            Route::post('files/{lesson_file}/viewed' , [LessonController::class , 'viewed'] );


            Route::post('courses/{course}/subscribe' ,[CourseController::class , 'subscribe']  );
            
        });        
    });



});

