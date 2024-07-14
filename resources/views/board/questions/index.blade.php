@extends('board.layout.master')

@section('page_title')
@lang('questions.show all questions') 
@endsection


@section('breadcrumb')
<a href="{{ route('board.questions.index') }}" class="breadcrumb-item"> @lang('questions.questions') </a>
<span class="breadcrumb-item active"> @lang('questions.show all questions')  </span>
@endsection

@section('page_content')
@livewire('board.questions.list-all-questions')
@endsection

