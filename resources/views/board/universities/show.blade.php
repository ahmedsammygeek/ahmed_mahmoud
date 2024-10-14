@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.universities.index') }}" class="breadcrumb-item"> الجامعات </a>
<span class="breadcrumb-item active"> عرض بيانات الجامعه </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
			<h5 class="mb-0"> عرض بيانات الجامعه </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-2' > تاريخ الاضافه </th>
						<td class='col-md-10' > {{ $university->created_at }} <span class='text-muted' > {{ $university->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تم الاضافه بواستطه </th>
							<td class='col-md-10' >  <a href="{{ route('board.admins.show' , $university->user ) }}"> {{ $university->user?->name }} </a> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم الجامعه بالعربيه </th>
							<td class='col-md-10' > {{ $university->getTranslation('name' , 'ar') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم الجامعه بالانجليزيه </th>
							<td class='col-md-10' > {{ $university->getTranslation('name' , 'en') }} </td>
						</tr>



						<tr  class='row' >
							<th class='col-md-2' > حاله الجامعه </th>
							<td class='col-md-10' > 
								@if ($university->is_active)
								<span class='badge bg-success' > فعال</span>
								@else
								<span class='badge bg-danger' > غير فعال </span>
								@endif
							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection