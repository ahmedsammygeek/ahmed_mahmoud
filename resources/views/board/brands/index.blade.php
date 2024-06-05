@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.brands.index') }}" class="breadcrumb-item"> العلامات التجاريه </a>
<span class="breadcrumb-item active"> عرض كافه العلامات التجاريه  </span>
@endsection

@section('page_content')
@include('board.layouts.messages')
@livewire('board.brands.list-all-brands')
@endsection

