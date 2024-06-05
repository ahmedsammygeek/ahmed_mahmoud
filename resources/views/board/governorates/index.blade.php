@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.governorates.index') }}" class="breadcrumb-item"> المحافظات </a>
<span class="breadcrumb-item active"> عرض كافه المحافظات  </span>
@endsection

@section('page_content')
@include('board.layouts.messages')
@livewire('board.governorates.list-all-governorates')
@endsection

