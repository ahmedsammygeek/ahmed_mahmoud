@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<span class="breadcrumb-item active"> @lang('students.show student installments') </span>
@endsection

@section('page_content')
<div class="navbar navbar-expand-lg border-bottom py-2">
	<div class="container-fluid">
		<ul class="nav navbar-nav flex-row flex-fill">
			<li class="nav-item me-1">
				<a href="{{ route('board.students.show' , $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-activity"></i>
						<span class="d-none d-lg-inline-block ms-2"> @lang('students.student details') </span>
					</div>
				</a>
			</li>

			<li class="nav-item me-1">
				<a href="{{ route('board.students.courses.index', $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						<span class="d-none d-lg-inline-block ms-2">
							@lang('students.courses')
						</span>
					</div>
				</a>
			</li>
			<li class="nav-item me-1">
				<a href="#schedule" class="navbar-nav-link navbar-nav-link-icon rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						<span class="d-none d-lg-inline-block ms-2">
							@lang('students.exams')
						</span>
					</div>
				</a>
			</li>
			<li class="nav-item me-1">
				<a  href="{{ route('board.students.installments.index', $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded active" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						<span class="d-none d-lg-inline-block ms-2">
							@lang('students.installments')
						</span>
					</div>
				</a>
			</li>
			<li class="nav-item me-1">
				<a href="{{ route('board.students.payments.index', $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded">
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						<span class="d-none d-lg-inline-block ms-2">
							@lang('students.payments')
						</span>
					</div>
				</a>
			</li>
			<li class="nav-item me-1">
				<a href="#settings" class="navbar-nav-link navbar-nav-link-icon rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-gear"></i>
						<span class="d-none d-lg-inline-block ms-2">Settings</span>
					</div>
				</a>
			</li>

			

		</ul>

	</div>
</div>
<!-- /profile navigation -->


<!-- Content area -->
<div class="content">
	<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">
		<div class="tab-content flex-fill order-2 order-lg-1">
			<div class="tab-pane fade active show " id="student_details">
				<div class="row">
					@livewire('board.students.list-all-student-installments' , ['student' => $student] )
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

