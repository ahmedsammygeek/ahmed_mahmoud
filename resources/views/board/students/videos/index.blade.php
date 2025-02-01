@extends('board.layout.master')

@section('page_title')
@lang('students.videos')
@endsection

@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<span class="breadcrumb-item active"> @lang('students.videos') </span>
@endsection

@section('page_content')
<div class="row">
    <div class="col-md-12">
        @livewire('board.students.videos.list-all-students')
    </div>
</div>

@endsection

