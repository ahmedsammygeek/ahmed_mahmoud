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
use App\Http\Controllers\Board\GroupController;
use App\Http\Controllers\Board\StudentCourseController;
use App\Http\Controllers\Board\StudentLessonController;
use App\Http\Controllers\Board\QuestionController;
use App\Http\Controllers\Board\ExamController;
use App\Http\Controllers\Board\ExamStudentController;
use App\Http\Controllers\Board\DashboardNotificationController;
use App\Http\Controllers\Board\SettingController;
use App\Http\Controllers\Board\GradeController;
use App\Http\Controllers\Board\EducationalSystemController;
use App\Http\Controllers\Board\TeacherController;
use App\Http\Controllers\Board\ProfileController;
use App\Http\Controllers\Board\PasswordController;
use App\Http\Controllers\Board\UserInstallmentController;
use App\Http\Controllers\Board\InstallmentController;
use App\Http\Controllers\Board\PaymentController;
use App\Http\Controllers\Board\StudentPaymentController;
use App\Http\Controllers\Board\StudentExamController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ApplicationController;

Route::get('/test' , [TestController::class , 'index'] );
Route::get('/contact' , [ContactUsController::class , 'index'] )->name('contact.index');
Route::post('/contact' , [ContactUsController::class , 'store'] )->name('contact.send');
Route::get('/application_form' , [ApplicationController::class , 'index'] )->name('application_form.index');
Route::post('/application_form' , [ApplicationController::class , 'store'] )->name('application_form.store');

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
                Route::resource('students.courses' , StudentCourseController::class);
                Route::resource('students.courses.lessons', StudentLessonController::class);
                Route::resource('students.installments', UserInstallmentController::class);
                Route::resource('students.payments', StudentPaymentController::class);
                Route::resource('students.exams', StudentExamController::class);

                Route::resource('installments', InstallmentController::class);
                Route::resource('payments', PaymentController::class);

                Route::resource('questions', QuestionController::class);
                Route::resource('exams', ExamController::class );
                Route::resource('grades', GradeController::class);
                Route::resource('educational_systems', EducationalSystemController::class);
                Route::get('exams/{exam}/students' ,[ ExamController::class , 'students' ] )->name('exams.students.index');
                
                Route::resource('exam_students', ExamStudentController::class );
                Route::resource('dashboard_notifications', DashboardNotificationController::class );
                Route::resource('admins', DashboardNotificationController::class );
                Route::resource('teachers', TeacherController::class );


                Route::resource('groups', GroupController::class );
                Route::get('groups/{group}/calendar' , [GroupController::class , 'calendar'])->name('groups.calendar');

                Route::get('/settings'  , [SettingController::class , 'edit'] )->name('settings.edit');
                Route::patch('/settings'  , [SettingController::class , 'update'] )->name('settings.update');


                Route::post('proccess_video_uploads' , [UploadLessonVideoController::class , 'store'] )->name('proccess_video_uploads');
                Route::patch('proccess_video_uploads' , [UploadLessonVideoController::class , 'store'] )->name('proccess_video_uploads');


                Route::get('/profile/edit' , [ProfileController::class , 'edit'] )->name('profile.edit');
                Route::patch('/profile' , [ProfileController::class , 'update'] )->name('profile.update');
                Route::get('/logout' , [ProfileController::class , 'logout'] )->name('profile.logout');


                Route::get('/password/edit' , [PasswordController::class , 'edit'] )->name('password.edit');
                Route::patch('/password' , [PasswordController::class , 'update'] )->name('password.update');

            });
        });




        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });
        
    });



