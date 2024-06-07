<?php

namespace App\Http\Controllers\Api\Student\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Student\V1\Auth\RegisterRequest;
use App\Models\Student;
use App\Models\PhoneVerificationCode;
use App\Traits\Api\GeneralResponse;
use App\Http\Resources\Api\Student\V1\Auth\StudentResource;
class RegisterController extends Controller
{
    use GeneralResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(RegisterRequest $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->password = $request->password;
        $student->mobile = $request->mobile;
        $student->guardian_mobile = $request->guardian_mobile;
        $student->grade = $request->grade;
        $student->educational_system_id = $request->educational_system_id;
        $student->app_language = $request->app_language;
        $student->firebase_fcm = $request->firebase_fcm;
        $student->mobile_serial_number = $request->mobile_serial_number;
        $student->app_platform = $request->app_platform;
        $student->save();

        $code = new PhoneVerificationCode;
        $code->code = '123456';
        $code->mobile = $request->mobile;
        $code->save();

        $data = [
            'user' => new StudentResource($student) , 
            'token' => $student->createToken($student->id)->plainTextToken
        ];

        return $this->response(
            data : $data  ,
            statusCode : 200 ,
            message : trans('api.registed successfully')

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
