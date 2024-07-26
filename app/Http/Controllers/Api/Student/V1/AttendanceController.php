<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseStudent;
use App\Models\Course;
use Auth;
use Carbon\Carbon;
use App\Http\Resources\Api\Student\V1\Attendance\StudentCourseAttendance;

use App\Traits\Api\GeneralResponse;
class AttendanceController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();

        $courses = Course::
        whereHas('students' , function($query) use($student) {
            $query->where('student_id' , $student->id );
        })
        ->get(); 

        $courses_attendance = [];



        foreach ($courses as $course) {
            $course->load(['sessions' => function($query) use($student , $course )  {
                $query
                ->where('group_id' , $student->courses()->where('course_id', $course->id )->first()?->group_id )
                ->whereDate('time_from' , '<=' , Carbon::today() )
                ->whereHas('attendedStudents', function($query) use($student) {
                    $query->where('student_id' , $student->id );
                });
            }]);
            $courses_attendance[] = new StudentCourseAttendance($course);
        }


        $data = [
            'courses_attendance' => $courses_attendance , 
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
