@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.payments.index') }}" class="breadcrumb-item"> @lang('payments.payments') </a>
<span class="breadcrumb-item active"> @lang('payments.show payment details') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0">  @lang('payments.show payment details') </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-2' > @lang('dashboard.created_at') </th>
							<td class='col-md-10' > {{ $payment->created_at }} <span class='text-muted' > {{ $payment->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' >@lang('dashboard.added by') </th>
							<td class='col-md-10' >  {{ $payment->user?->name }}  </td>
						</tr>


						<tr class='row' >
							<th class='col-md-2' >@lang('payments.amount') </th>
							<td class='col-md-10' >  {{ $payment->amount }}  <span class='text-muted'> جنيه </span> </td>
						</tr>



						<tr class='row' >
							<th class='col-md-2' >@lang('payments.student') </th>
							<td class='col-md-10' >  {{ $payment->student?->name }}  </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' >@lang('payments.course') </th>
							<td class='col-md-10' >  {{ $payment->course?->title }}  </td>
						</tr>




						{{-- @if ($payment->is_paid)
						<tr class='row' >
							<th class='col-md-2' >@lang('payments.payment details') </th>
							<td class='col-md-10' > 
								<a href="{{ route('board.payments.show' , $payment->student_payment_id ) }}"> اضغط هنا </a>
							</td>
						</tr>
						@endif --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection