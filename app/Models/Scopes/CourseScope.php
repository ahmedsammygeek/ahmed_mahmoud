<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Auth;
use Request;
class CourseScope implements Scope
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
                $builder->where('teacher_id' , Auth::id() );
                break;
                case 3:
                break;
            }
        }
    }
}
