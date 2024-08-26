@extends('board.layout.master')


@section('breadcrumb')
<span class="breadcrumb-item active"> لوحه التحكم </span>
@endsection

@section('page_content')
<div class="row">
	<legend> احصائيات عامه للمشروع </legend>

	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-success text-white">
			<a href="{{ route('board.students.index') }}" style="text-decoration: none; color: inherit;">
				<div class="d-flex align-items-center">
					<div class="flex-fill">
						<h4 class="mb-0 counter"> {{ $students_count }} </h4>
						@lang('dashboard.students count')
					</div>
					<i class="ph-users-four ph-2x opacity-75 ms-3"></i>
				</div>
			</a>
		</div>
	</div>

	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-info text-white">
			<a href="{{ route('board.admins.index') }}" style="text-decoration: none; color: inherit;">
				<div class="d-flex align-items-center">
					<div class="flex-fill">
						<h4 class="mb-0 counter"> {{ $admins_count }} </h4>
						@lang('dashboard.admins count')
					</div>
					<i class="ph-users  ph-2x opacity-75 ms-3"></i>
				</div>
			</a>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-primary text-white">
			<a href="{{ route('board.teachers.index') }}" style="text-decoration: none; color: inherit;">
				<div class="d-flex align-items-center">
					<div class="flex-fill">
						<h4 class="mb-0"> {{ $teachers_count }} </h4>
						@lang('dashboard.teachers count')
					</div>
					<i class="ph-users  ph-2x opacity-75 ms-3"></i>
				</div>
			</a>
		</div>
	</div>


	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-success text-white">
			<a href="{{ route('board.courses.index') }}" style="text-decoration: none; color: inherit;">
				<div class="d-flex align-items-center">
					<div class="flex-fill">
						<h4 class="mb-0"> {{ $courses_count }} </h4>
						@lang('dashboard.courses count')
					</div>
					<i class="ph-users-four ph-2x opacity-75 ms-3"></i>
				</div>
			</a>
		</div>
	</div>


	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-success text-white">
			<a href="{{ route('board.groups.create') }}" style="text-decoration: none;color: inherit;">
				<div class="d-flex align-items-center">
					<i class="ph-chart-pie  ph-2x opacity-75 me-3"></i>
					<div class="flex-fill text-end">
						<h4 class="mb-0"> {{ $groups_count }} </h4>
						@lang('dashboard.groups count')
					</div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-primary text-white">
			<a href="{{ route('board.exams.index') }}" style="text-decoration: none;color: inherit;">
				<div class="d-flex align-items-center">
					<i class="ph-book  ph-2x opacity-75 me-3"></i>
					<div class="flex-fill text-end">
						<h4 class="mb-0"> {{ $exams_count }} </h4>
						@lang('dashboard.exams count')
					</div>
				</div>
			</a>
		</div>
	</div> 
</div>

@endsection


@section('scripts')

<script src="{{ asset('board_assets/js/counterup.min.js') }}"></script>

<script >
	$(function() {
		$('.counter').counterUp();
	});
</script>
@endsection