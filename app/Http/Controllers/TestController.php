<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Student = Student::find(1);
        // $student = new Student;
        // $student->name = 'student name';
        // $student->email = 'student@yahoo.com';
        // $student->password = '123456789';
        // $student->mobile = '+201014340346';
        // $student->guardian_mobile = '+201014340346';
        // $student->grade = 12;
        // $student->educational_system_id = 1;
        // $student->app_serial_number = 'dfhdfjkd5890r58rfdlfgkj50986590865906';
        // $student->save();


        dd($Student->createToken($Student->id)->plainTextToken);
        
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
