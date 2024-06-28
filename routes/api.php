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


Route::group(['prefix' => 'student/v1'], function() {

    Route::post('/register' , [RegisterController::class , 'index'] );    
    Route::post('/login' , [LoginController::class , 'index'] );   
    Route::post('forget-password' , [ForgetPasswordController::class , 'index'] );
    Route::post('forget-password/verify' , [ForgetPasswordController::class , 'verify'] );
    Route::post('forget-password/change-password' , [ForgetPasswordController::class , 'change_password']);


    Route::get('educational_systems' , [EducationalSystemController::class , 'index'] );
    Route::get('grades' , [GradeController::class , 'index'] );
    Route::get('/splashes' , [SplashController::class , 'index'] );


    Route::group(['middleware' => ['auth:student']  ], function() {
        Route::post('/verification' , [PhoneVerificationController::class , 'index'] );
        Route::post('/verification/code/send' , [PhoneVerificationController::class , 'send_code'] );

        Route::get('/profile' , [ProfileController::class , 'index'] ); 
        Route::group(['middleware' => 'phone_verification'], function() {
            Route::post('/logout' , [LogoutController::class , 'index'] ); 
            Route::patch('/profile' , [ProfileController::class , 'update'] ); 
            Route::get('/home' , [HomeController::class , 'index'] );
            Route::get('/search' , [SearchController::class , 'index'] );
            Route::get('/teachers' , [TeacherController::class , 'index'] );
            Route::get('/teachers/{teacher}' , [TeacherController::class , 'show'] );
            Route::get('/courses' , [CourseController::class , 'index'] );
            Route::get('/courses/{course}' , [CourseController::class , 'show'] );
            Route::get('/courses/{course}/lessons/{lesson}' , [LessonController::class , 'show'] );
            Route::get('exams/{exam}' , [ExamController::class , 'show'] );
            Route::get('notifications' , [NotificationController::class , 'index'] );
            Route::post('notifications' , [NotificationController::class , 'read'] );
        });        
    });



});

