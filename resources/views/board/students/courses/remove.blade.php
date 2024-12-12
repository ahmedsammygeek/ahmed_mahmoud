@extends('board.layout.master')

@section('page_title')
@lang('students.show all students')
@endsection

@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<span class="breadcrumb-item active">  @lang('students.show all students')  </span>
@endsection

@section('page_content')

@livewire('board.students.courses.remove-students-from-courses')

@endsection

