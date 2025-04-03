<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Student , Course , Lesson , LibraryStudent , LessonFileView , LessonFile , LibraryStudentUnit};
use Auth;
use Carbon\Carbon;


class StudentLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Student $student)
    {

        return view('board.students.library.index' , compact('student') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Student $student)
    {
        $courses = Course::select('title'  , 'id')->get();
        return view('board.students.library.create' , compact('student' , 'courses') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Student $student)
    {
        // dd($request->all());

        $user_id = Auth::id();
        foreach ($request->courses as $one_course) {

            $dose_students_has_this_course = LibraryStudent::where('student_id' , $student->id )
            ->where('course_id', $one_course )->first();
            if (!$dose_students_has_this_course) {
                $default_course_library_options = get_default_course_library_options($one_course);
                $default_course_library_views = get_default_course_library_views($one_course);

                // dd($default_course_library_views , $one_course );


                $student_course = new LibraryStudent;
                $student_course->user_id =  $user_id ;
                $student_course->student_id = $student->id;
                $student_course->course_id = $one_course;
                $student_course->is_allowed = 1;
                $student_course->save();
                $student_units = [];
                foreach ($request->student_units[$one_course] as $student_unit) {

                    $student_units[] = new LibraryStudentUnit([
                        'student_id' => $student->id , 
                        'user_id' => $user_id , 
                        'unit_id' => $student_unit , 
                        'is_allowed' => 1 , 
                        'course_id' => $one_course,
                    ]);
                }
                $student->libraryUnits()->saveMany($student_units);
                $course = Course::find($one_course);
                $lessons = Lesson::whereHas('unit' , function($query) use($request , $one_course ) {
                    $query->whereIn('unit_id' , $request->student_units[$one_course] );
                })->pluck('id')->toArray();

                $files = LessonFile::whereIn('lesson_id' , $lessons )->get();

                $student_files = [];
                foreach ($files as $file) {
                    $student_files[] = [
                        'student_id' => $student->id , 
                        'lesson_file_id' => $file->id , 
                        'total_views_till_now' => 0 , 
                        'total_downloads_till_now' => 0 , 
                        'allowed_views_number' => $default_course_library_views['default_library_views_number'] , 
                        'allowed_downloads_number' => $default_course_library_views['default_library_download_number'] , 
                        'force_water_mark' => $default_course_library_options['force_water_mark'] , 
                        'allow_download' => $default_course_library_options['allow_download'] , 
                        'water_mark_text' => $student->mobile , 
                        'user_id' => $user_id , 
                        'created_at' => Carbon::now() , 
                        'updated_at' => Carbon::now() , 
                    ];
                }
                LessonFileView::insert($student_files);
            }        
        }


        return redirect(route('board.students.library.index' , $student))->with('success' , trans('courses.library added successfully' ) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student , Course $library)
    {
        $student_course = LibraryStudent::with(['course' , 'user'])->where('student_id' , $student->id )
        ->where('course_id' , $library->id )
        ->latest()
        ->first();

        return view('board.students.library.show' , compact('student_course') );

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


    public function files(Student $student , Course $library)
    {
        // code...
    }
}
