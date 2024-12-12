@extends('board.layout.master')

@section('page_title')
@lang('trash.show all trashed students')
@endsection

@section('breadcrumb')
<a href="{{ route('board.trashed.students') }}" class="breadcrumb-item"> @lang('trash.trashed students') </a>
<span class="breadcrumb-item active">  @lang('students.show all students')  </span>
@endsection

@section('page_content')

@livewire('board.trash.list-all-trashed-students')

@endsection

