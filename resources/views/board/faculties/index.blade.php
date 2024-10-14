@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.faculties.index') }}" class="breadcrumb-item"> الكليات </a>
<span class="breadcrumb-item active"> عرض كافه الكليات  </span>
@endsection

@section('page_content')
@include('board.layout.messages')
@livewire('board.faculties.list-all-faculties')
@endsection

