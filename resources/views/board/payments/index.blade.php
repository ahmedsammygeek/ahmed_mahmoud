@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.payments.index') }}" class="breadcrumb-item"> @lang('payments.payments') </a>
<span class="breadcrumb-item active"> @lang('payments.list all payments')  </span>
@endsection

@section('page_content')
@livewire('board.payments.list-all-payments')
@endsection

