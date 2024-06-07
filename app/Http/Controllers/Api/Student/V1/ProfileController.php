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
        
        if ($request->hasFile('profile_picture')) {
            $student->profile_picture = basename($request->file('profile_picture')->store('students'));
        }

        $student->grade = $request->grade;
        $student->educational_system_id = $request->educational_system_id;
        $student->name = $request->name;
        // $student->mobile = $request->mobile;
        $student->save();


        return $this->response(
            message : trans('api.profile updated successfully') , 
            statusCode : 200
        );
    }

}
