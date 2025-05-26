@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<span class="breadcrumb-item active"> @lang('students.show student details') </span>
@endsection

@section('page_content')
@if ($student->isBanned())
<div class="alert bg-danger text-white alert-icon-start alert-dismissible fade show border-0">
	<span class="alert-icon bg-black bg-opacity-20">
		<i class="ph-x-circle"></i>
	</span>
	<span class="fw-semibold"> تنبيه !</span> هذا الطالب تم حظره بسبب :  {{ $student->banning_message }} 
	<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif
<div class="navbar navbar-expand-lg border-bottom py-2">

	<div class="container-fluid">
		<ul class="nav nav-tabs nav-tabs-highlight">
			<li class="nav-item ">
				<a href="{{ route('board.students.show' , $student ) }}" class="nav-link  rounded active" >
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
						المكتبه
					</div>
				</a>
			</li>

			<li class="nav-item ">
				<a  href="{{ route('board.students.exams.index', $student ) }}" class="nav-link  rounded" >
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

	<!-- Inner container -->
	<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">

		<!-- Left content -->
		<div class="tab-content flex-fill order-2 order-lg-1">
			<div class="tab-pane fade active show " id="student_details">

				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header bg-primary text-white">
								<h5 class="mb-0">  @lang('students.show student details') </h5>
							</div>

							<div class='card-body' >
								<table  class='table table-bordered table-responsive table-striped'>
									<tbody>
										<tr>
											<th> @lang('students.created at') </th>
											<td>{{ $student->created_at }}<span class='text-muted'>{{ $student->created_at->diffForHumans() }} </span> </td>
										</tr>
										<tr>
											<th> @lang('students.added by') </th>
											<td> 
												@if ($student->user_id)
												<p> {{ $student->user?->name }} </p>
												@else
												@lang('students.student join via mobile app')
												@endif
											</td>
										</tr>
										<tr>
											<th> @lang('students.code') </th>
											<td> {{ $student->code }} </td>
										</tr>
										<tr>
											<th> @lang('students.name') </th>
											<td> {{ $student->name }} </td>
										</tr>

										<tr>
											<th>  @lang('students.mobile') </th>
											<td> {{ $student->mobile }} </td>
										</tr>
										<tr>
											<th>  @lang('students.guardian mobile') </th>
											<td> {{ $student->guardian_mobile }} </td>
										</tr>
										<tr>
											<th>  @lang('students.educational system') </th>
											<td> {{ $student->educationalSystem?->name }} </td>
										</tr>
										<tr>
											<th>  @lang('students.grade') </th>
											<td> {{ $student->grade?->name }} </td>
										</tr>
										<tr>
											<th>  @lang('students.grade') </th>
											<td> {{ $student->grade?->name }} </td>
										</tr>
										<tr>
											<th>  @lang('students.mobile serial number') </th>
											<td> {{ $student->mobile_serial_number }} </td>
										</tr>
										<tr>
											<th>  @lang('students.app platform') </th>
											<td> {{ $student->app_platform }} </td>
										</tr>
										<tr>
											<th>  @lang('students.mobile serial number') </th>
											<td> {{ $student->mobile_serial_number }} </td>
										</tr>

										<tr>
											<th>  @lang('students.student type') </th>
											<td> 
												@switch($student->student_type)
												@case(1)
												<span class='badge bg-primary' > @lang('students.only center student') </span>
												@break
												@case(2)
												<span class='badge bg-success' >@lang('students.only mobile student')   </span>
												@break
												@case(3)
												<span class='badge bg-info' > @lang('students.student can use both') </span>
												@break
												@endswitch

											</td>
										</tr>

										<tr>
											<th>  @lang('students.is verified') </th>
											<td> 
												@if ($student->phone_verified_at)
												<span class="badge bg-primary"> @lang('students.yes') </span>
												@else
												<span class="badge bg-danger"> @lang('students.no') </span>
												@endif
											</td>
										</tr>
										<tr>
											<th>  @lang('students.is banned') </th>
											<td> 
												@if ($student->is_banned)
												<span class="badge bg-danger"> @lang('students.yes') </span>
												<br>
												<span> {{ $student->banning_message }} </span>
												@else
												<span class="badge bg-primary"> @lang('students.no') </span>
												@endif
											</td>
										</tr>


									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>


			</div>

{{-- 			<div class="tab-pane fade " id="courses">
				@livewire('board.students.list-all-student-courses' , ['student' => $student] )
			</div>

			<div class="tab-pane fade" id="settings">



			</div> --}}
		</div>
		<!-- /left content -->




	</div>
	<!-- /inner container -->

</div>
<!-- /content area -->
@endsection

