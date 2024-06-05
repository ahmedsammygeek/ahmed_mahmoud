@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.categories.index') }}" class="breadcrumb-item"> الاقسام </a>
<span class="breadcrumb-item active"> عرض بيانات القسم </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> عرض بيانات القسم </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-2' > تاريخ الاضافه </th>
							<td class='col-md-10' > {{ $category->created_at }} <span class='text-muted' > {{ $category->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تم الاضافه بواستطه </th>
							<td class='col-md-10' >  <a href="{{ route('board.admins.show' , $category->user ) }}"> {{ $category->user?->name }} </a> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم القسم بالعربيه </th>
							<td class='col-md-10' > {{ $category->getTranslation('name' , 'ar') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم القسم بالانجليزيه </th>
							<td class='col-md-10' > {{ $category->getTranslation('name' , 'en') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تفاصيل القسم بالعربيه </th>
							<td class='col-md-10' > {{ $category->getTranslation('description' , 'ar') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تفاصيل القسم بالانجليزيه </th>
							<td class='col-md-10' > {{ $category->getTranslation('description' , 'en') }} </td>
						</tr>


						<tr  class='row' >
							<th class='col-md-2' > البريد الاكترنى </th>
							<td class='col-md-10' > 
								@if ($category->is_active)
								<span class='badge bg-success' > فعال</span>
								@else
								<span class='badge bg-danger' > غير فعال </span>
								@endif
							</td>
						</tr>

						<tr  class='row' >
							<th class='col-md-2' > صوره القسم الحاليه </th>
							<td class='col-md-10' > <img class='img-responsive img-thumbnail' src="{{ Storage::url('categories/'.$category->image) }}" alt=""> </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection