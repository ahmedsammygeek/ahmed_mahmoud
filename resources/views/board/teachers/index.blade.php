@extends('board.layout.master')

@section('page_title')
@lang('teachers.show all teachers')
@endsection

@section('breadcrumb')
<a href="{{ route('board.teachers.index') }}" class="breadcrumb-item"> @lang('teachers.teachers') </a>
<span class="breadcrumb-item active">  @lang('teachers.show all teachers')  </span>
@endsection

@section('page_content')

@livewire('board.teachers.list-all-teachers')

@endsection

