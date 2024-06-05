@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.items.index') }}" class="breadcrumb-item"> الاصناف </a>
<span class="breadcrumb-item active"> عرض كافه الاصناف  </span>
@endsection

@section('page_content')
@include('board.layouts.messages')
@livewire('board.items.list-all-items')
@endsection

