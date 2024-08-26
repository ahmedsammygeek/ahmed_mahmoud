@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.installments.index') }}" class="breadcrumb-item"> @lang('installments.installments') </a>
<span class="breadcrumb-item active"> @lang('installments.list all installments')  </span>
@endsection

@section('page_content')
@livewire('board.installments.list-all-installments')
@endsection

