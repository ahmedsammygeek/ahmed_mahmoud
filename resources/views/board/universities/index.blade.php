@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.universities.index') }}" class="breadcrumb-item"> الجامعات </a>
<span class="breadcrumb-item active"> عرض كافه الجامعات  </span>
@endsection

@section('page_content')
@include('board.layout.messages')
@livewire('board.universities.list-all-universities')
@endsection

