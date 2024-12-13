@extends('board.layout.master')

@section('page_title')
@lang('exams_students.show all students') 
@endsection


@section('breadcrumb')
<a href="{{ route('board.exams.index') }}" class="breadcrumb-item"> @lang('exams.show all exams') </a>
<a href="{{ route('board.exams.show' , $exam ) }}" class="breadcrumb-item"> {{ $exam->title }} </a>
<a href="{{ route('board.exams.students.index' , $exam ) }}" class="breadcrumb-item"> @lang('exams.students') </a>

@endsection

@section('page_content')
@livewire('board.exams.list-all-exam-students' , ['exam' => $exam ] )
@endsection

