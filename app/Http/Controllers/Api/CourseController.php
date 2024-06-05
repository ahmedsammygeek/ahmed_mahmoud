<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseMember;
use App\Models\Course;
use App\Http\Resources\Api\Courses\CourseResource;
use App\Http\Requests\Api\Courses\StoreCourseMemberRequest;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::where('is_active' , 1 )->latest()->get();
        return response()->json([
            'status' => true  , 
            'errors' => [] ,
            'message' => '' , 
            'data' => (object) [
                'courses' => CourseResource::collection($courses) , 
            ]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function join(StoreCourseMemberRequest $request  , Course $course )
    {

        // we need to check first if this member joind the course before or not

        $member = CourseMember::where([
            ['phone' , '=' , $request->phone] , 
            ['email' , '=' , $request->email] , 
            ['course_id' , '=' , $course->id] , 
        ])->first();

        if ($member) {
            return response()->json([
                'status' => true  , 
                'errors' => [] ,
                'message' => trans('api.joind_indeed') , 
                'data' => (object) []
            ], 200);
        }


        $member = new CourseMember;
        $member->name = $request->name;
        $member->phone = $request->phone;
        $member->email = $request->email;
        $member->comments = $request->comments;
        $member->course_id = $course->id;
        $member->save();


        return response()->json([
            'status' => true  , 
            'errors' => [] ,
            'message' => trans('api.join_success') , 
            'data' => (object) []
        ], 200);
    }

}
