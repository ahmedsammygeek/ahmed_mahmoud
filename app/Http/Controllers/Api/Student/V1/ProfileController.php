<?php

namespace App\Http\Controllers\Api\Student\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\V1\Auth\StudentResource;
use Auth;
use App\Http\Requests\Api\Student\V1\Profile\UpdateProfileRequest;
class ProfileController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        $data = [
            'student' => new StudentResource($student)
        ];
        return $this->response(
            data : $data  ,
            statusCode : 200 ,
        );
    }



    public function update(UpdateProfileRequest $request)
    {
        $student = Auth::guard('student')->user();
        
        if ($request->hasFile('image')) {
            $student->profile_picture = basename($request->file('image')->store('students'));
        }

        $student->grade_id = $request->grade;
        $student->educational_system_id = $request->educational_system_id;
        $student->name = $request->name;
        $student->save();

        $data = [
            'student' => new StudentResource($student) , 
        ];

        return $this->response(
            message : trans('api.profile updated successfully') , 
            statusCode : 200 , 
            data : $data , 
        );
    }


    public function delete()
    {
        $student = Auth::guard('student')->user();
        $student->delete();

        return $this->response(
            message : trans('api.profile deleted successfully') , 
            statusCode : 200 , 
        );
    }

}
