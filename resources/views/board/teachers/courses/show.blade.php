@extends('board.layout.master')

@section('page_title')
@lang('courses.show course details')
@endsection

@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<a href="{{ route('board.students.show' , $student_course->student ) }}" class="breadcrumb-item"> {{ $student_course->student?->name }} </a>
<a href="{{ route('board.students.courses.index' , $student_course->student ) }}" class="breadcrumb-item"> @lang('students.courses') </a>
<span class="breadcrumb-item active"> @lang('courses.show student course details') </span>
@endsection

@section('page_content')
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class='card-body'>
                <table class='table table-bordered table-responsive table-striped'>
                    <tbody>
                        <tr>
                            <th class='col-md-3' > @lang('courses.created at') </th>
                            <td class='col-md-9' > 
                                {{ $student_course->created_at }} <span class='text-muted'> {{ $student_course->created_at->diffForHumans() }} </span> 
                            </td>
                        </tr>

                        <tr>
                            <th class='col-md-3' >  @lang('courses.added by') </th>
                            <td class='col-md-9' > 
                                {{ $student_course->user?->name }} 
                            </td>
                        </tr>

                        <tr>
                            <th class='col-md-3' > @lang('courses.course title')  </th>
                            <td class='col-md-9' > {{ $student_course->course?->title }} </td>
                        </tr>

                        <tr>
                            <th class='col-md-3' > @lang('course.group name')  </th>
                            <td class='col-md-9' > {{ $student_course->group?->name }} </td>
                        </tr>

                        <tr>
                            <th class='col-md-3' > @lang('course.progress')  </th>
                            <td class='col-md-9' > <span class='badge bg-primary'> {{ $student_course->progress }} %  </span>  </td>
                        </tr>

                        <tr>
                            <th class='col-md-3' > @lang('courses.force headphones') </th>
                            <td class='col-md-9' >
                                @switch($student_course->force_headphones)
                                @case(1)
                                <span class="badge bg-primary"> @lang('courses.yes') </span>
                                @break
                                @case(0)
                                <span class="badge bg-danger"> @lang('courses.no')  </span>
                                @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th class='col-md-3' > @lang('courses.allow to watch course') </th>
                            <td class='col-md-9' >
                                @switch($student_course->allow)
                                @case(1)
                                <span class="badge bg-primary"> @lang('courses.yes') </span>
                                @break

                                @case(0)
                                <span class="badge bg-danger"> @lang('courses.no') </span>
                                <span> {{ $student_course->disable_reason }} </span>
                                @break
                                @endswitch
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
