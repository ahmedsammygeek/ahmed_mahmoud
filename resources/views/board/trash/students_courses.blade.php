@extends('board.layout.master')

@section('page_title')
@lang('trash.show all trashed lessons')
@endsection

@section('breadcrumb')
<a href="{{ route('board.trashed.lessons') }}" class="breadcrumb-item"> @lang('trash.trashed lessons') </a>
<span class="breadcrumb-item active">  @lang('lessons.show all lessons')  </span>
@endsection

@section('page_content')

@livewire('board.trash.list-all-trashed-students-courses')

@endsection

