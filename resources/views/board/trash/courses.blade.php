@extends('board.layout.master')

@section('page_title')
@lang('trash.show all trashed courses')
@endsection

@section('breadcrumb')
<a href="{{ route('board.trashed.courses') }}" class="breadcrumb-item"> @lang('trash.trashed courses') </a>
<span class="breadcrumb-item active">  @lang('courses.show all courses')  </span>
@endsection

@section('page_content')

@livewire('board.trash.list-all-trashed-courses')

@endsection

