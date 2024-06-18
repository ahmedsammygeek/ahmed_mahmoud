<?php

namespace App\Actions\Board\Courses;
use App\Models\Course;
use App\Models\CourseEducationalSystem;
use App\Models\CourseTeacher;
use Illuminate\Http\Request;
use Auth;
class UpdateCourseAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function execute(Request $request , Course $course)
    {

        if ($request->hasFile('image')) {
            $course->image = basename($request->file('image')->store('courses'));
        }
       
        $course->setTranslation('title', 'ar', $request->title_ar)
        ->setTranslation('title', 'en', $request->title_en)
        ->setTranslation('content', 'ar', $request->content_ar)
        ->setTranslation('content', 'en', $request->content_en );
        $course->price = $request->price;
        $course->grade_id = $request->grade;
        $course->is_active = $request->filled('active') ? 1 : 0;
        $course->suggest_course = $request->filled('show_in_home') ? 1 : 0;
        $course->save();

        

        if ($request->filled('educational_system_id')) {
            $systems = [];
            $course->educationalSystems()->delete();
            foreach ($request->educational_system_id as $educational_system) {

                $systems[] = new CourseEducationalSystem([
                    'course_id' => $course->id , 
                    'educational_system_id' => $educational_system , 
                    'user_id' => Auth::id() , 
                ]);
            }

            $course->educationalSystems()->saveMany($systems);
        }
        
        if ($request->filled('teachers')) {
            $course->teachers()->delete(); 
            $course_teachers = [];
            foreach ($request->teachers as $teacher) {

                $course_teachers[] = new CourseTeacher([
                    'course_id' => $course->id , 
                    'teacher_id' => $teacher , 
                    'user_id' => Auth::id() , 
                ]);
            }

            $course->teachers()->saveMany($course_teachers);            
        }

        return true;
    }

}
