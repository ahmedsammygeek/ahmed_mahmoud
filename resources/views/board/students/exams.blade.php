@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<span class="breadcrumb-item active"> @lang('students.show student exams') </span>
@endsection

@section('page_content')
<div class="navbar navbar-expand-lg border-bottom py-2">
	<div class="container-fluid">
		<ul class="nav nav-tabs nav-tabs-highlight">
			<li class="nav-item ">
				<a href="{{ route('board.students.show' , $student ) }}" class="nav-link  rounded " >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-activity"></i>
						@lang('students.student details')
					</div>
				</a>
			</li>

			<li class="nav-item ">
				<a href="{{ route('board.students.courses.index', $student ) }}" class="nav-link  rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						@lang('students.courses')
					</div>
				</a>
			</li>
			<li class="nav-item ">
				<a href="{{ route('board.students.library.index' , $student ) }}" class="nav-link  rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-gear"></i>
						تقارير الماليه للطالب
					</div>
				</a>
			</li>

			<li class="nav-item ">
				<a  href="{{ route('board.students.exams.index', $student ) }}" class="nav-link active rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						@lang('students.exams')
					</div>
				</a>
			</li>
			<li class="nav-item ">
				<a href="{{ route('board.students.installments.index' , $student ) }}" class="nav-link rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						@lang('students.installments')
					</div>
				</a>
			</li>
			<li class="nav-item ">
				<a href="{{ route('board.students.payments.index' , $student ) }}" class="nav-link navbar-nav-link-icon rounded">
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						
							@lang('students.payments')
						
					</div>
				</a>
			</li>
			<li class="nav-item ">
				<a href="{{ route('board.students.financial_reports.index' , $student ) }}" class="nav-link  rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-gear"></i>
						تقارير الماليه للطالب
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
					@livewire('board.students.list-all-student-exams' , ['student' => $student] )
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

