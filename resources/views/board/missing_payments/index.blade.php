@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.missing_payments.index') }}" class="breadcrumb-item">  الحاسابات المفقوده  </a>
<span class="breadcrumb-item active"> عرض كافه الحسابات المفقوده </span>
@endsection

@section('page_content')
@livewire('board.missing-payments.list-all-missing-payments')
@endsection

