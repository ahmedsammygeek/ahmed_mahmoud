@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.faculty_levels.index') }}" class="breadcrumb-item"> السنوات الدراسيه  </a>
<span class="breadcrumb-item active"> عرض كافه السنوات الدراسيه   </span>
@endsection

@section('page_content')
@include('board.layout.messages')
@livewire('board.faculties-levels.list-all-faculties-levels')
@endsection

