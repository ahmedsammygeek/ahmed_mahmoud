@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.slides.index') }}" class="breadcrumb-item"> عارض الصور </a>
<span class="breadcrumb-item active"> عرض كافه الصور  </span>
@endsection

@section('page_content')

@livewire('board.slides.list-all-slides')

@endsection

