<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\Home\SlideResource;
use App\Http\Resources\Api\Student\Home\TeacherResource;
use App\Models\Slide;
use App\Models\Teacher;
use App\Models\CourseTeacherGroupStudent;
use App\Models\Course;
use Auth;

use App\Http\Resources\Api\Student\V1\Home\StudentCourseResource;
class HomeController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        $courses = Course::whereHas('teachers' , function($query) use($student) {
            $query->whereHas('groups' , function($query) use($student) {
                $query->whereHas('students' , function($query) use($student) {
                    $query->where('student_id' , $student->id );
                });
            });
        })->get();


        $suggested_courses = Course::query()
        ->where('grade_id' , $student->grade_id )
        ->whereNotIn('id' , $courses->pluck('id')->toArray())
        ->whereHas('educationalSystems' , function($query) use($student) {
            $query->where('educational_system_id' , $student->educational_system_id );
        })
        ->get();

        $slides = Slide::active()->latest()->get();
        $teachers = Teacher::suggested()->get();

        $data = [
            'slides' => SlideResource::collection($slides) , 
            'teachers' => TeacherResource::collection($teachers) , 
            'my_courses' => StudentCourseResource::collection($courses) , 
            'my_courses' => StudentCourseResource::collection($suggested_courses) , 
        ];


        return $this->response(

            data : $data , 
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
