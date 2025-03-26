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
use App\Http\Controllers\Board\UniversityController;
use App\Http\Controllers\Board\FacultyController;
use App\Http\Controllers\Board\FacultyLevelController;
use App\Http\Controllers\Board\StudentFinancialReportController;
use App\Http\Controllers\Board\VideoController;
use App\Http\Controllers\Board\AnnouncementController;
use App\Http\Controllers\Board\StudentTrashController;
use App\Http\Controllers\Board\CourseTrashController;
use App\Http\Controllers\Board\LessonTrashController;
use App\Http\Controllers\Board\StudentCourseTrashController;
use App\Http\Controllers\Board\StudentDeviceController;
use App\Http\Controllers\Board\SplashController;
use App\Http\Controllers\Board\LibraryController;
use App\Http\Controllers\Board\StudentVideoViewsController;
use App\Http\Controllers\Board\CourseStudentController;
use App\Http\Controllers\Board\StudentUnitcontroller;
use App\Http\Controllers\Board\StudentLibraryController;
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
            Route::group(['middleware' => ['admin' , 'check_if_admin_blocked' ] ], function() {
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
                Route::get('courses/{course}/fix', [CourseController::class , 'fix'] )->name('courses.fix');
                Route::resource('universities', UniversityController::class );
                Route::resource('faculties', FacultyController::class );
                Route::resource('faculty_levels', FacultyLevelController::class );
                Route::resource('courses.units', CourseUnitController::class );
                Route::resource('courses.students' , CourseStudentController::class);
                Route::get('courses/students/step_two' , [CourseStudentController::class , 'step_two' ])->name('courses.students.create.step_two');
                Route::post('courses/students/step_two' , [CourseStudentController::class , 'store' ])->name('courses.students.create.step_two.store');
                Route::resource('courses.units.lessons', LessonController::class);
                Route::resource('students.courses' , StudentCourseController::class);
                Route::resource('students.courses.lessons', StudentLessonController::class);
                Route::resource('students.courses.units', StudentUnitcontroller::class);
                Route::resource('students.installments', UserInstallmentController::class);
                Route::resource('students.payments', StudentPaymentController::class);
                Route::resource('students.exams', StudentExamController::class);
                Route::resource('students.financial_reports', StudentFinancialReportController::class);
                Route::resource('installments', InstallmentController::class);
                Route::resource('payments', PaymentController::class);
                Route::resource('videos', VideoController::class);
                Route::resource('announcements', AnnouncementController::class);
                Route::resource('splashes', SplashController::class);
                Route::resource('students.library',StudentLibraryController::class);

                Route::get('/students/courses/create_multi' , [StudentCourseController::class , 'create_multi' ])->name('students.courses.create_multi');


                Route::get('/students/courses/create' , [StudentCourseController::class , 'create'] )->name('students.courses.create');


                Route::get('/students/courses/allow/units' , [StudentCourseController::class , 'allow_units'] )->name('students.courses.allow.units');

                Route::get('/students/courses/remove' , [StudentCourseController::class , 'remove'] )->name('students.courses.remove');

                Route::get('/students/courses/allow/lessons' , [StudentCourseController::class , 'allow_lessons'] )->name('students.courses.allow.lessons');

                Route::get('/students/courses/allow/lessons' , [StudentCourseController::class , 'allow_lessons'] )->name('students.courses.allow.lessons');


                Route::get('/students_videos' , [StudentVideoViewsController::class , 'index'] )->name('students.videos');


                Route::get('/students/devices/manipluate'  , [StudentDeviceController::class , 'index'])->name('students.devices.manipluate');

                Route::resource('questions', QuestionController::class);
                Route::resource('exams', ExamController::class );
                Route::resource('grades', GradeController::class);
                Route::resource('educational_systems', EducationalSystemController::class);
                Route::get('exams/{exam}/students' ,[ ExamController::class , 'students' ] )->name('exams.students.index');
                
                Route::resource('exam_students', ExamStudentController::class );
                Route::resource('dashboard_notifications', DashboardNotificationController::class );
                // Route::resource('admins', DashboardNotificationController::class );
                Route::resource('teachers', TeacherController::class );
                Route::get('teachers/{teacher}/login', [TeacherController::class , 'login' ] )->name('teachers.login');


                Route::resource('groups', GroupController::class );
                Route::get('groups/{group}/calendar' , [GroupController::class , 'calendar'])->name('groups.calendar');

                Route::get('/settings' , [SettingController::class , 'edit'] )->name('settings.edit');
                Route::patch('/settings' , [SettingController::class , 'update'] )->name('settings.update');


                Route::post('proccess_video_uploads', [UploadLessonVideoController::class , 'store'])->name('proccess_video_uploads');
                Route::patch('proccess_video_uploads', [UploadLessonVideoController::class , 'store'])->name('proccess_video_uploads');


                Route::get('/profile/edit' , [ProfileController::class , 'edit'] )->name('profile.edit');
                Route::patch('/profile' , [ProfileController::class , 'update'] )->name('profile.update');
                Route::get('/logout' , [ProfileController::class , 'logout'] )->name('profile.logout');


                Route::get('/password/edit' , [PasswordController::class , 'edit'] )->name('password.edit');
                Route::patch('/password' , [PasswordController::class , 'update'] )->name('password.update');
                Route::get('library/assgin_students' , [LibraryController::class , 'assgin_students'] )->name('library.students');

                Route::resource('library', LibraryController::class );


                Route::group(['prefix' => 'trash'], function() {

                    Route::get('/students' , [StudentTrashController::class , 'index'])->name('trash.index');
                    Route::get('/students' , [StudentTrashController::class , 'index'])->name('trashed.students');
                    Route::get('/courses' , [CourseTrashController::class , 'index'])->name('trashed.courses');
                    Route::get('/lessons' , [LessonTrashController::class , 'index'])->name('trashed.lessons');
                    Route::get('/students_courses' , [StudentCourseTrashController::class , 'index'])->name('trashed.students_courses');
                    // Route::get('/videos' , [CourseTrashController::class , 'index'])->name('trashed.videos');
                    // Route::get('/units' , [CourseTrashController::class , 'index'])->name('trashed.units');
                    // Route::get('/questions' , [CourseTrashController::class , 'index'])->name('trashed.questions');
                    // Route::get('/units' , [CourseTrashController::class , 'index'])->name('trashed.units');


                });

            });
});




Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});

});



