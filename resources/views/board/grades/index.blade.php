@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.grades.index') }}" class="breadcrumb-item"> @lang('grades.grades') </a>
<span class="breadcrumb-item active"> @lang('grades.list all grades') </span>
@endsection

@section('page_content')

@livewire('board.grades.list-all-grades')
@endsection

