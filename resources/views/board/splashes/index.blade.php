@extends('board.layout.master')

@section('page_title')
@lang('splashes.show all splashes') 
@endsection


@section('breadcrumb')
<a href="{{ route('board.splashes.index') }}" class="breadcrumb-item"> @lang('splashes.splashes') </a>
<span class="breadcrumb-item active"> @lang('splashes.show all splashes')  </span>
@endsection

@section('page_content')
@livewire('board.splashes.list-all-splashes')
@endsection

