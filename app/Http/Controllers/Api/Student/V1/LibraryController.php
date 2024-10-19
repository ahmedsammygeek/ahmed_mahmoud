<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Student , LessonFileView , Course , CourseStudent , Lesson , LessonFile };
use Auth;
use App\Traits\Api\GeneralResponse;

use App\Http\Resources\Api\Student\V1\Library\{CourseResource , LessonResource , LessonFileResource  , FileResource};

class LibraryController extends Controller
{

    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();


        $courses_id = CourseStudent::whereHas('course' , function($query) use ($student) {
            $query->where('student_id', $student->id )->whereHas('units' , function($query) use($student) {
                $query->whereHas('lessons' , function($query) use($student) {
                    $query->whereHas('files' , function($query) use($student) {
                        $query->whereHas('views' , function($query)  use($student) {
                         $query->whereIn('lesson_file_id' , $student->LessonsFilesViews()->pluck('lesson_file_id')->toArray() );
                     });
                    });
                });
            });
        })->pluck('course_id')->toArray();


        $courses = Course::whereIn('id' , $courses_id )->get();

        $data = [
            'courses' => CourseResource::collection($courses) , 
        ];

        return $this->response(
            data : $data ,
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show_lesson(Course $course)
    {

        $student = Auth::guard('student')->user();

        // we need to check if this user has this course or not 

        $student_course = CourseStudent::where([
            ['student_id' , '=' , $student->id ] , 
            ['course_id' , '=' , $course->id ]
        ])->first();

        if (!$student_course) {

            return $this->response(
                status : 'error' , 
                message : 'you do not has this course in your profile'
            );
        }


        if ($student_course->allow == 0 ) {

            return $this->response(
                status : 'error' , 
                message :  $student_course->disable_reason ? $student_course->disable_reason : 'تم ايقاف هذا الكورس لك..تواصل مع الدعم' 
            );
        }

        // dd( $course->units()->pluck('units.id')->toArray());

        $lessons = Lesson::whereIn('unit_id' , $course->units()->pluck('units.id')->toArray())
        ->whereHas('files' , function($query) use($student) {
            $query->whereHas('views' , function($query) use($student) {
                $query->where('student_id' , $student->id );
            });
        })->get();


        $data = [
            'lessons' => LessonResource::collection($lessons) , 
        ];

        return $this->response(
            data : $data , 
        );
    }



    public function show_files(Course $course  , Lesson $lesson )
    {
        $student = Auth::guard('student')->user();

        // we need to check if this user has this course or not 

        $student_course = CourseStudent::where([
            ['student_id' , '=' , $student->id ] , 
            ['course_id' , '=' , $course->id ]
        ])->first();

        if (!$student_course) {

            return $this->response(
                status : 'error' , 
                message : 'you do not has this course in your profile'
            );
        }

        if ($student_course->allow == 0 ) {

            return $this->response(
                status : 'error' , 
                message :  $student_course->disable_reason ? $student_course->disable_reason : 'تم ايقاف هذا الكورس لك..تواصل مع الدعم' 
            );
        }


        // now we need to get this lesson files , 


        $files = LessonFileView::with('lessonFile')->where('student_id' , $student->id )
        ->whereHas('lessonFile' , function($query) use($lesson)  {
            $query->whereHas('lesson' , function($query) use($lesson)  {
                $query->whereHas('files' , function($query) use($lesson) {
                    $query->where('lesson_file_id' , $lesson->id  );
                });
            });
        })->get();

        $data = [
            'files' => LessonFileResource::collection($files),
        ];

        return $this->response(
            data : $data
        );

        // return $files;
    }



    public function show_file(Course $course  , Lesson $lesson  , LessonFile $file )
    {

        $student = Auth::guard('student')->user();

        // we need to check if this user has this course or not 

        $student_course = CourseStudent::where([
            ['student_id' , '=' , $student->id ] , 
            ['course_id' , '=' , $course->id ]
        ])->first();

        if (!$student_course) {

            return $this->response(
                status : 'error' , 
                message : 'you do not has this course in your profile'
            );
        }

        if ($student_course->allow == 0 ) {

            return $this->response(
                status : 'error' , 
                message :  $student_course->disable_reason ? $student_course->disable_reason : 'تم ايقاف هذا الكورس لك..تواصل مع الدعم' 
            );
        }

        $lesson_file_view = LessonFileView::where('lesson_file_id' , $file->id )->where('student_id' , $student->id )->first();

        if (!$lesson_file_view) {
            return $this->response(
                status : 'error' , 
                message :  'غير مصرح لك بمشاهده هذا الملف' , 
                statusCode : 404
            );
        }

        if (!$lesson_file_view->is_allowed) {
            return $this->response(
                status : 'error' , 
                message :  'غير مسموح لك  بمشاهده هذا الملف' , 
            );
        }

        if (!$lesson_file_view->allowed_views_number) {
            return $this->response(
                status : 'error' , 
                message :  'تم انتهاء عدد مشاهدات الملف' , 
            );
        }


        $data = [
            'file' => new FileResource($lesson_file_view) , 
        ];

        return $this->response(

            data : $data , 
        );

    }


    public function download_file(Course $course  , Lesson $lesson  , LessonFile $file )
    {
        $student = Auth::guard('student')->user();

        // we need to check if this user has this course or not 

        $student_course = CourseStudent::where([
            ['student_id' , '=' , $student->id ] , 
            ['course_id' , '=' , $course->id ]
        ])->first();

        if (!$student_course) {

            return $this->response(
                status : 'error' , 
                message : 'you do not has this course in your profile'
            );
        }

        if ($student_course->allow == 0 ) {

            return $this->response(
                status : 'error' , 
                message :  $student_course->disable_reason ? $student_course->disable_reason : 'تم ايقاف هذا الكورس لك..تواصل مع الدعم' 
            );
        }

        $lesson_file_view = LessonFileView::where('lesson_file_id' , $file->id )->where('student_id' , $student->id )->first();

        if (!$lesson_file_view) {
            return $this->response(
                status : 'error' , 
                message :  'غير مصرح لك بمشاهده هذا الملف' , 
                statusCode : 404
            );
        }

        if (!$lesson_file_view->is_allowed) {
            return $this->response(
                status : 'error' , 
                message :  'غير مسموح لك  بمشاهده هذا الملف' , 
            );
        }

        if (!$lesson_file_view->allowed_downloads_number) {
            return $this->response(
                status : 'error' , 
                message :  'تم انتهاء عدد التحميلات الملف' , 
            );
        }


        $data = [
            'file' => new FileResource($lesson_file_view) , 
        ];

        return $this->response(

            data : $data , 
        );
    }


    public function markFileAsViewed(Course $course  , Lesson $lesson  , LessonFile $file )
    {
        $student = Auth::guard('student')->user();

        // we need to check if this user has this course or not 

        $lesson_file_view = LessonFileView::where([
            ['student_id' , '=' , $student->id ] , 
            ['lesson_file_id' , '=' , $file->id ]
        ])->first();

        if (!$lesson_file_view) {

            return $this->response(
                status : 'error' , 
                message : 'you do not has this file in your library'
            );
        }


        $lesson_file_view->increment('total_views_till_now' , 1 );
        $lesson_file_view->decrement('allowed_views_number' , 1 );

        return $this->response(
            message : 'تمت احتساب المشاهدهه بنجاح'
        );


    }

    public function markFileAsDownloaded(Course $course  , Lesson $lesson  , LessonFile $file )
    {
        $student = Auth::guard('student')->user();

        // we need to check if this user has this course or not 

        $lesson_file_view = LessonFileView::where([
            ['student_id' , '=' , $student->id ] , 
            ['lesson_file_id' , '=' , $file->id ]
        ])->first();

        if (!$lesson_file_view) {

            return $this->response(
                status : 'error' , 
                message : 'you do not has this file in your library'
            );
        }


        $lesson_file_view->increment('total_downloads_till_now' , 1 );
        $lesson_file_view->decrement('allowed_downloads_number' , 1 );

        return $this->response(
            message : 'تمت احتساب التحميل بنجاح'
        );


    }

}
