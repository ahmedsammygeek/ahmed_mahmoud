<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Board\BoardController;
use App\Http\Controllers\Board\AdminLoginController;
use App\Http\Controllers\Board\AdminController;
use App\Http\Controllers\Board\CategoryController;
use App\Http\Controllers\Board\ItemController;
use App\Http\Controllers\Board\SlideController;
use App\Http\Controllers\Board\BrandController;
use App\Http\Controllers\Board\GovernorateController;
use App\Http\Controllers\Board\CityController;
use App\Http\Controllers\Board\StudentController;
use App\Http\Controllers\Board\CourseController;
use App\Http\Controllers\Board\CourseUnitController;
use App\Http\Controllers\Board\LessonController;
use App\Http\Controllers\Board\UploadLessonVideoController;
use App\Http\Controllers\TestController;



Route::get('/test' , [TestController::class , 'index'] );



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
        Route::group(['prefix' => 'Board' , 'as' => 'board.' ], function() {
            Route::get('/login' , [AdminLoginController::class , 'form'] )->name('login.form');
            Route::post('/login' , [AdminLoginController::class , 'login'] )->name('login');
            Route::group(['middleware' => ['admin'] ], function() {
                Route::get('/' , [BoardController::class , 'index'] )->name('index');
                Route::resource('admins', AdminController::class);
                Route::resource('categories', CategoryController::class);
                Route::resource('items', ItemController::class);
                Route::resource('slides', SlideController::class);
                Route::resource('brands', BrandController::class);
                Route::resource('governorates', GovernorateController::class);
                Route::resource('cities', CityController::class);
                Route::resource('students', StudentController::class );
                Route::resource('courses', CourseController::class );
                Route::resource('courses.units', CourseUnitController::class );
                Route::resource('courses.units.lessons', LessonController::class);




                Route::post('proccess_video_uploads' , [UploadLessonVideoController::class , 'store'] )->name('proccess_video_uploads');
                Route::patch('proccess_video_uploads' , [UploadLessonVideoController::class , 'store'] )->name('proccess_video_uploads');

            });
        });




        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });
        
    });



