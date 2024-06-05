<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Student\V1\Auth\RegisterController;
use App\Http\Controllers\Api\Student\V1\Auth\LoginController;


Route::group(['prefix' => 'student/v1'], function() {
    

    Route::post('/register' , [RegisterController::class , 'index'] );    
    Route::post('/login' , [LoginController::class , 'index'] );    





    // Route::get('/student', function (Request $request) {
    //     return $request->user();
    // })->middleware('auth:student');


});

