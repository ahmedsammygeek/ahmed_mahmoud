@extends('board.layout.master')

@section('page_title')
@lang('courses.show course details')
@endsection

@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<a href="{{ route('board.students.show' , $student ) }}" class="breadcrumb-item"> {{ $student->name }} </a>
<a href="{{ route('board.students.courses.index' , ['student' => $student] ) }}" class="breadcrumb-item"> @lang('students.courses') </a>
<a href="{{ route('board.students.courses.show' , ['student' => $student , 'course' => $course ] ) }}" class="breadcrumb-item"> @lang('students.courses') </a>
<span class="breadcrumb-item active"> @lang('courses.course lessons') </span>
@endsection

@section('page_content')
<div class="row">
    <div class="col-md-12">
        @livewire('board.students.courses.list-all-course-lesson' , ['course' => $course  , 'student' => $student ] )
    </div>
</div>

@endsection

