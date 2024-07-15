<?php

namespace App\Actions\Board\Courses\Units;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Unit;
class UpdateUnitAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    public function execute(Request $request ,Course $course , Unit $unit  )
    {
        $unit->course_id = $course->id;
        $unit
        ->setTranslation('title'  , 'ar' , $request->title_ar )
        ->setTranslation('title'  , 'en' , $request->title_en );
        $unit->is_active = $request->filled('is_active') ? 1 : 0;
        $unit->save();
        return true;
    }
}
