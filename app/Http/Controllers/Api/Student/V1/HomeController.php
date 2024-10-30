<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\Home\SlideResource;
use App\Http\Resources\Api\Student\Home\TeacherResource;

use App\Models\{Slide  , Teacher  , CourseStudent ,  Course  , Announcement };
use Auth;
use App\Http\Resources\Api\Student\V1\Home\{StudentCourseResource , StudentSuggestedCourseResource , AnnouncementResource };
class HomeController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $is_user = false;
        if (Auth::guard('student')->check()) {
            $is_user = true;
            $student = Auth::guard('student')->user();
            $student_courses = CourseStudent::with('course')->where('student_id' , $student->id )->get();
            $suggested_courses = Course::query()
            ->where('grade_id' , $student->grade_id )
            ->whereNotIn('id' , $student_courses->pluck('course_id')->toArray() )
            ->whereHas('educationalSystems' , function($query) use($student) {
                $query->where('educational_system_id' , $student->educational_system_id );
            })
            ->get();
        } else {
            $suggested_courses = Course::query()
            ->where('suggest_course' , 1 )
            ->get();
        }
    

        $slides = Slide::active()->latest()->get();
        $teachers = Teacher::suggested()->get();
        $announcements = Announcement::where('is_active' , 1 )->get();

        $data = [
            'slides' => SlideResource::collection($slides) , 
            'teachers' => TeacherResource::collection($teachers) , 
            'my_courses' => $is_user ? StudentCourseResource::collection($student_courses) : [] , 
            'suggested_courses' => StudentSuggestedCourseResource::collection($suggested_courses) , 
            'announcements' => AnnouncementResource::collection( $announcements ) , 
        ];

        return $this->response(
            data : $data , 
        );
    }


    public function markAnnouncementAsDownloaded(Announcement $announcement)
    {
        

        return $this->response(
            message : 'تمت المشاهده بنجاح' , 
        );
    }
}
