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
Route::group(['prefix' => 'student/v1'], function() {


    Route::post('/register' , [RegisterController::class , 'index'] );    
    Route::post('/login' , [LoginController::class , 'index'] );   


    Route::post('forget-password' , [ForgetPasswordController::class , 'index'] );
    Route::post('forget-password/verify' , [ForgetPasswordController::class , 'verify'] );
    Route::post('forget-password/change-password' , [ForgetPasswordController::class , 'change_password']);


    Route::group(['middleware' => ['auth:student']  ], function() {
        Route::post('/verification' , [PhoneVerificationController::class , 'index'] );
        Route::post('/verification/code/send' , [PhoneVerificationController::class , 'send_code'] );

        Route::get('/profile' , [ProfileController::class , 'index'] ); 
        Route::group(['middleware' => 'phone_verification'], function() {
            Route::post('/logout' , [LogoutController::class , 'index'] ); 
            Route::patch('/profile' , [ProfileController::class , 'update'] ); 
            Route::get('/home' , [HomeController::class , 'index'] );
        });        
    });



});

