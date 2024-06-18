@extends('board.layout.master')

@section('page_title')
@lang('courses.show all courses') 
@endsection

@section('breadcrumb')
    <a href="{{ route('board.courses.index') }}" class="breadcrumb-item"> @lang('courses.courses') </a>
    <span class="breadcrumb-item active"> @lang('courses.show all courses') </span>
@endsection

@section('page_content')

    @livewire('board.courses.list-all-courses')

@endsection
