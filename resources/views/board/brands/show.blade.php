@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.brands.index') }}" class="breadcrumb-item"> العلامات التجاريه </a>
<span class="breadcrumb-item active"> عرض بيانات العلامه </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> عرض بيانات العلامه </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-2' > تاريخ الاضافه </th>
							<td class='col-md-10' > {{ $brand->created_at }} <span class='text-muted' > {{ $brand->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تم الاضافه بواستطه </th>
							<td class='col-md-10' >  <a href="{{ route('board.admins.show' , $brand->user_id ) }}"> {{ $brand->user?->name }} </a> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم العلامه بالعربيه </th>
							<td class='col-md-10' > {{ $brand->getTranslation('name' , 'ar') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم العلامه بالانجليزيه </th>
							<td class='col-md-10' > {{ $brand->getTranslation('name' , 'en') }} </td>
						</tr>


						<tr class='row' >
							<th class='col-md-2' > الصنف التباع له العلامه </th>
							<td class='col-md-10' > {{ $brand->item?->name }} </td>
						</tr>




						<tr  class='row' >
							<th class='col-md-2' > حاله العلامه </th>
							<td class='col-md-10' > 
								@if ($brand->is_active)
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