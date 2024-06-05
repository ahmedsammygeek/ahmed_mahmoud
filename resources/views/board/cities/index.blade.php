@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.cities.index') }}" class="breadcrumb-item"> المدن </a>
<span class="breadcrumb-item active"> عرض كافه المدن  </span>
@endsection

@section('page_content')
@include('board.layouts.messages')
@livewire('board.cities.list-all-cities')
@endsection

