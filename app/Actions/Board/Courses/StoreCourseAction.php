<?php

namespace App\Actions\Board\Courses;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseEducationalSystem;
use App\Models\CourseTeacher;
use Auth;
class StoreCourseAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    public function execute(Request $request)
    {

        $course = new Course;
        $course->image = basename($request->file('image')->store('courses'));
        $course->setTranslation('title', 'ar', $request->title_ar)
        ->setTranslation('title', 'en', $request->title_en)
        ->setTranslation('content', 'ar', $request->content_ar)
        ->setTranslation('content', 'en', $request->content_en );
        $course->price = $request->price;
        $course->grade_id = $request->grade;
        $course->is_active = $request->filled('active') ? 1 : 0;
        $course->suggest_course = $request->filled('show_in_home') ? 1 : 0;
        $course->user_id = Auth::id();
        $course->teacher_id = $request->teacher_id;
        $course->save();

        

        if ($request->filled('educational_system_id')) {
            $systems = [];
            foreach ($request->educational_system_id as $educational_system) {
                $systems[] = new CourseEducationalSystem([
                    'course_id' => $course->id , 
                    'educational_system_id' => $educational_system , 
                    'user_id' => Auth::id() , 
                ]);
            }
            $course->educationalSystems()->saveMany($systems);
        }
        

        return true;
    }

}
