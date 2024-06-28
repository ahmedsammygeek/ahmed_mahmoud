@extends('board.layout.master')

@section('page_title')
@lang('students.add new student')
@endsection

@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<span class="breadcrumb-item active"> @lang('students.add new student') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('students.add new student') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.students.store') }}">
				<div class="card-body">
					@csrf
					@livewire('board.students.add-new-student')
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.students.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection