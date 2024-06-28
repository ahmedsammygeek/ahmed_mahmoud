@extends('board.layout.master')

@section('page_title')
@lang('groups.show all groups') 
@endsection


@section('breadcrumb')
<a href="{{ route('board.groups.index') }}" class="breadcrumb-item"> @lang('groups.groups') </a>
<span class="breadcrumb-item active"> @lang('groups.show all groups')  </span>
@endsection

@section('page_content')
@livewire('board.groups.list-all-groups')
@endsection

