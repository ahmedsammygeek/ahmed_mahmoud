<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Course , Student  , CourseStudent , StudentUnit , LessonVideo , StudentLesson , LessonFile , LessonFileView  };
use Auth;
use Carbon\Carbon;
use App\Http\Requests\Board\Courses\Students\AddCoursesToStudentsRequest;
class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $course_students = Student::with('faculty')
        ->whereHas('courses' , function($query) use($course) {
            $query->where('course_id' , $course->id );
        })->count();
        return view('board.courses.students' , compact('course' , 'course_students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function step_two(Request $request)
    {

        $courses = Course::find($request->courses);
        $students = $request->students;
        return view('board.courses.add_multiple_students_to_multiple_courses' , compact('courses' , 'students') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCoursesToStudentsRequest $request)
    {
        // dd($request->all());


        if (!$request->filled('force_headphones')) {
            $request->force_headphones = [];
        }

        if (!$request->filled('show_phone_on_viedo')) {
            $request->show_phone_on_viedo = [];
        }

        if (!$request->filled('speak_user_phone')) {
            $request->speak_user_phone = [];
        }

        if (!$request->filled('force_face_detecting')) {
            $request->force_face_detecting = [];
        }

        if (!$request->filled('online_library')) {
            $request->online_library = [];
        }


        foreach ($request->courses as $one_course) {

            $course = Course::where('id' , $one_course )->first();
            foreach ($request->students as $one_student_id) {

                $student = Student::where('id' , $one_student_id )->first();

                $student_course = new CourseStudent;
                $student_course->user_id = Auth::id();
                $student_course->student_id = $student->id;
                $student_course->course_id = $course->id;
                $student_course->group_id = $request->groups[$course->id];
                $student_course->force_headphones = array_key_exists($course->id, $request->force_headphones) ? 1 : 0;
                $student_course->show_phone_on_viedo = array_key_exists($course->id, $request->show_phone_on_viedo) ? 1 : 0;
                $student_course->speak_user_phone = array_key_exists($course->id, $request->speak_user_phone) ? 1 : 0;
                $student_course->force_face_detecting = array_key_exists($course->id, $request->force_face_detecting) ? 1 : 0;
                $student_course->online_library = array_key_exists($course->id, $request->online_library) ? 1 : 0;
                $student_course->allow = 1;

                $student_course->save();


                $student_units = [];
                foreach ($request->units[$course->id] as $one_unit) {
                    $student_units[] = new StudentUnit([
                        'student_id' => $student->id , 
                        'user_id' => Auth::id() , 
                        'unit_id' => $one_unit , 
                        'is_allowed' => 1 , 
                    ]);
                    $student->units()->saveMany($student_units);
                    $videos = LessonVideo::whereHas('lesson' , function($query) use($request , $course ) {
                        $query->whereIn('unit_id' , $request->units[$course->id] );
                    })->get();
                    $student_lessons = [];
                    foreach ($videos as $video) {
                        $student_lessons[] = new StudentLesson([
                            'lesson_id' => $video->lesson_id , 
                            'user_id' => Auth::id(), 
                            'student_id' => $student->id , 
                            'allowed_views' => $course->default_view_number , 
                            'remains_views' => $course->default_view_number , 
                            'total_views_till_now' => 0  ,
                            'video_id' => $video->id
                        ]);
                        if (array_key_exists($course->id, $request->online_library)) {
                            $lesson_files = LessonFile::where('lesson_id' , $video->lesson_id )->get();
                            $student_lesson_files = [];
                            foreach ($lesson_files as $lesson_file) {
                                $student_lesson_files[] = [
                                    'student_id' => $student->id , 
                                    'lesson_file_id' => $lesson_file->id , 
                                    'total_views_till_now' => 0 , 
                                    'total_downloads_till_now' => 0 , 
                                    'allowed_views_number' => 10 , 
                                    'allowed_downloads_number' => 10 , 
                                    'force_water_mark' =>  1  , 
                                    'water_mark_text' => 't3leem' , 
                                    'user_id' => Auth::id() , 
                                    'created_at' => Carbon::now() , 
                                    'updated_at' => Carbon::now() , 
                                ];
                            }
                            LessonFileView::insert($student_lesson_files);
                        }

                    }
                    $student->lessons()->saveMany($student_lessons);
                }
            }
        }


        return redirect(route('board.students.courses.create'))->with('success' , 'تم اضافه الطلاب بنجاح' );
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
