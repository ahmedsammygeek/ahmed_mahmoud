<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Auth;
use Request;
class VideoScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (!Request::wantsJson()) {
            switch (Auth::user()->type) {
                case 1:
                break;
                case 2:
                $teacher = Auth::user();
                $courses_ids_for_this_teacher = $teacher->coursesAsTeacher()->pluck('id')->toArray();
                $builder->whereHas('lesson', function($query) use ($courses_ids_for_this_teacher) {
                    $query->whereHas('unit' , function($query) use ($courses_ids_for_this_teacher){
                        $query->whereIn('course_id' , $courses_ids_for_this_teacher );
                    });
                });
                break;
                case 3:
                break;
            }
        }
    }
}
