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
				<a  href="{{ route('board.students.exams.index', $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded" >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						<span class="d-none d-lg-inline-block ms-2">
							@lang('students.exams')
						</span>
					</div>
				</a>
			</li>
			<li class="nav-item me-1">
				<a  href="{{ route('board.students.installments.index', $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded " >
					<div class="d-flex align-items-center mx-lg-1">
						<i class="ph-calendar"></i>
						<span class="d-none d-lg-inline-block ms-2">
							@lang('students.installments')
						</span>
					</div>
				</a>
			</li>
			<li class="nav-item me-1">
				<a href="{{ route('board.students.payments.index', $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded active">
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
					<div class="card">
						<div class="card-header d-flex align-items-center py-0">
							<h5 class="py-3 mb-0"> تقرير مدفوعات الطاب </h5>
							<div class="d-inline-flex ms-auto">
								<button type="button" class="btn btn-light ms-3"><i class="ph-printer me-2"></i> طباعه </button>
							</div>
						</div>

						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="mb-4">
										<div class="d-inline-flex align-items-center mt-2 mb-3">
											<img src="{{ asset('board_assets/am_academy_logo.jpeg') }}" class="h-24px" alt="">
											<h4 class="d-none d-sm-inline-block text-body mb-0 ms-2"> تطبيق مستر احمد محمود </h4>
										</div>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="text-sm-end mb-4">
										<h4 class="text-primary mb-2 mt-lg-2"> الطالب : {{ $student->name }} </h4>
										<ul class="list list-unstyled mb-0">
											<li> تاريخ الطباعه : <span class="fw-semibold"> {{ Carbon\Carbon::now()->toDateTimeString() }} </span></li>
											<li> رقم الموبيل : <span class="fw-semibold"> {{ $student->mobile }} </span></li>
										</ul>
									</div>
								</div>
							</div>

							<div class="d-lg-flex flex-lg-wrap">
								<div class="mb-2 ms-auto">
									<span class="text-muted">Payment Details:</span>
									<div class="d-flex flex-wrap wmin-lg-400">
										<ul class="list list-unstyled mb-0">
											<li><h5 class="my-2"> اجمالى المدفوع:</h5></li>
											<li> <h5 class="my-2"> اجمالى المتبقى: </h5></li>
										</ul>

										<ul class="list list-unstyled text-end mb-0 ms-auto">
											<li><h5 class="my-2"> {{ $payments->sum('amount') }} <span class='text-muted' > جنيه </span> </h5></li>
											<li><h5 class="my-2"> {{ $installments->where('is_paid' , 0 )->sum('amount') }} <span class='text-muted' > جنيه </span> </h5></li>
											
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<h3 class='text-center' > المدفوعات السابقه </h3>
							<table class="table table-lg">

								<thead>
									<tr>
										<th>الكورس</th>
										<th>المبلغ</th>
										<th>تاريخ الدفع</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($payments as $payment)
									<tr>

										<td> {{ $payment->course?->title }} </td>
										<td> {{ $payment->amount }}  <span class='text-muted' > جنيه </span>  </td>
										<td><span class="fw-semibold"> {{ $payment->created_at->toDateTimeString() }} </span></td>
									</tr>
									@endforeach

								</tbody>
							</table>
						</div>

						<div class="table-responsive">
							<h3 class='text-center' > المبالغ المستحقه </h3>
							<table class="table table-lg">
								
								<thead>
									<tr>
										<th>الكورس</th>
										<th>المبلغ</th>
										<th>تاريخ الاستحقاق</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($installments as $installment)
									<tr>
										
										<td> {{ $installment->course?->title }} </td>
										<td> {{ $installment->amount }}  <span class='text-muted' > جنيه </span>  </td>
										<td><span class="fw-semibold"> {{ $installment->due_date }} </span></td>
									</tr>
									@endforeach
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

