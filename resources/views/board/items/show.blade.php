@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.items.index') }}" class="breadcrumb-item"> الاصناف </a>
<span class="breadcrumb-item active"> عرض بيانات الصنف </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> عرض بيانات الصنف </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-2' > تاريخ الاضافه </th>
							<td class='col-md-10' > {{ $item->created_at }} <span class='text-muted' > {{ $item->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تم الاضافه بواستطه </th>
							<td class='col-md-10' >  <a href="{{ route('board.admins.show' , $item->user_id ) }}"> {{ $item->user?->name }} </a> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم الصنف بالعربيه </th>
							<td class='col-md-10' > {{ $item->getTranslation('name' , 'ar') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم الصنف بالانجليزيه </th>
							<td class='col-md-10' > {{ $item->getTranslation('name' , 'en') }} </td>
						</tr>


						<tr class='row' >
							<th class='col-md-2' > القسم </th>
							<td class='col-md-10' > {{ $item->category?->name }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > عدد النقاط </th>
							<td class='col-md-10' > {{ $item->points }} <span class='text-muted' > نقطه </span> </td>
						</tr>


						<tr  class='row' >
							<th class='col-md-2' > حاله الصنف </th>
							<td class='col-md-10' > 
								@if ($item->is_active)
								<span class='badge bg-success' > فعال</span>
								@else
								<span class='badge bg-danger' > غير فعال </span>
								@endif
							</td>
						</tr>

						<tr  class='row' >
							<th class='col-md-2' > صوره الصنف الحاليه </th>
							<td class='col-md-10' > <img class='img-responsive img-thumbnail' src="{{ Storage::url('items/'.$item->image) }}" alt=""> </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection