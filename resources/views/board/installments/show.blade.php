@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.installments.index') }}" class="breadcrumb-item"> @lang('installments.installments') </a>
<span class="breadcrumb-item active"> @lang('installments.show installment details') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0">  @lang('installments.show installment details') </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-2' > @lang('dashboard.crated_at') </th>
							<td class='col-md-10' > {{ $installment->created_at }} <span class='text-muted' > {{ $installment->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' >@lang('dashboard.added by') </th>
							<td class='col-md-10' >  {{ $installment->user?->name }}  </td>
						</tr>


						<tr class='row' >
							<th class='col-md-2' >@lang('installments.amount') </th>
							<td class='col-md-10' >  {{ $installment->amount }}  <span class='text-muted'> جنيه </span> </td>
						</tr>



						<tr class='row' >
							<th class='col-md-2' >@lang('installments.due_date') </th>
							<td class='col-md-10' >  
								{{ $installment->due_date }}
							</td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' >@lang('installments.student') </th>
							<td class='col-md-10' >  {{ $installment->student?->name }}  </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' >@lang('installments.course') </th>
							<td class='col-md-10' >  {{ $installment->course?->title }}  </td>
						</tr>


						<tr class='row' >
							<th class='col-md-2' >@lang('installments.is_paid') </th>
							<td class='col-md-10' > 

								@switch($installment->is_paid)
								@case(0)
								<span class='badge bg-danger' > @lang('installments.unpaid') </span>
								@break
								@case(1)
								<span class='badge bg-success' > @lang('installments.paid') </span>
								@break
								@endswitch 
							</td>
						</tr>
						<tr class='row' >
							<th class='col-md-2' >@lang('installments.change_to_paid_by') </th>
							<td class='col-md-10' > 
								{{ $installment->ChangeToPaidBy?->name }}
							</td>
						</tr>

						@if ($installment->is_paid)
						<tr class='row' >
							<th class='col-md-2' >@lang('installments.payment details') </th>
							<td class='col-md-10' > 
								<a href="{{ route('board.payments.show' , $installment->student_payment_id ) }}"> اضغط هنا </a>
							</td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection