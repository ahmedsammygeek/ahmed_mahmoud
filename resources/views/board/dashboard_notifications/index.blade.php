@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.cities.index') }}" class="breadcrumb-item"> المدن </a>
<span class="breadcrumb-item active"> عرض كافه المدن  </span>
@endsection

@section('page_content')
@livewire('board.dashboard-notifications.list-all-notifications')
@endsection

