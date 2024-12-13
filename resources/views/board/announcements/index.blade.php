@extends('board.layout.master')

@section('page_title')
@lang('exams.show all exams') 
@endsection


@section('breadcrumb')
<a href="{{ route('board.exams.index') }}" class="breadcrumb-item"> @lang('exams.exams') </a>
<span class="breadcrumb-item active"> @lang('exams.show all exams')  </span>
@endsection

@section('page_content')
@livewire('board.exams.list-all-exams')
@endsection

