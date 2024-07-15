@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.educational_systems.index') }}" class="breadcrumb-item"> @lang('educational_systems.educational systems') </a>
<span class="breadcrumb-item active"> @lang('educational_systems.list all educational systems') </span>
@endsection

@section('page_content')

@livewire('board.educational-systems.list-all-educational-systems')
@endsection

