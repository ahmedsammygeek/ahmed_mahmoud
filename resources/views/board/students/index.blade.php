@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.admins.index') }}" class="breadcrumb-item"> المشرفين </a>
<span class="breadcrumb-item active"> عرض كافه المشرفين  </span>
@endsection

@section('page_content')

@livewire('board.admins.list-all-admins')

@endsection

