<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Student\V1\Auth\RegisterController;
use App\Http\Controllers\Api\Student\V1\Auth\LoginController;
use App\Http\Controllers\Api\Student\V1\Auth\LogoutController;
use App\Http\Controllers\Api\Student\V1\ProfileController;


Route::group(['prefix' => 'student/v1'], function() {
    

    Route::post('/register' , [RegisterController::class , 'index'] );    
    Route::post('/login' , [LoginController::class , 'index'] );    
    


    Route::group(['middleware' => 'auth:student'], function() {
        Route::post('/logout' , [LogoutController::class , 'index'] ); 
        Route::get('/profile' , [ProfileController::class , 'index'] ); 
    });



});

