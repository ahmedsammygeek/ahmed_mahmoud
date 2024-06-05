@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.categories.index') }}" class="breadcrumb-item"> الاقسام </a>
<span class="breadcrumb-item active"> عرض كافه الاقسام  </span>
@endsection

@section('page_content')
@include('board.layouts.messages')
@livewire('board.categories.list-all-categories')
@endsection

