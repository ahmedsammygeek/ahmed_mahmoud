<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Auth;
use Request;
class StudentScope implements Scope
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
            $courses_ids = $teacher->coursesAsTeacher()->pluck('id')->toArray();
            $builder->whereHas('courses', function($query) use ($courses_ids) {
                $query->whereIn('course_id' , $courses_ids );
            });
            break;
            case 3:
            break;
        }
        }
        
    }
}
