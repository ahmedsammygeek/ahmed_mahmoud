@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.faculty_levels.index') }}" class="breadcrumb-item"> السنوات الدراسيه </a>
<span class="breadcrumb-item active"> عرض بيانات النسه </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> عرض بيانات السنه </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-2' > تاريخ الاضافه </th>
							<td class='col-md-10' > {{ $faculty_level->created_at }} <span class='text-muted' > {{ $faculty_level->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تم الاضافه بواستطه </th>
							<td class='col-md-10' >  <a href="{{ route('board.admins.show' , $faculty_level->user ) }}"> {{ $faculty_level->user?->name }} </a> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > الاسم بالعربيه </th>
							<td class='col-md-10' > {{ $faculty_level->getTranslation('name' , 'ar') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > الاسم بالانجليزيه </th>
							<td class='col-md-10' > {{ $faculty_level->getTranslation('name' , 'en') }} </td>
						</tr>



						<tr  class='row' >
							<th class='col-md-2' > الحاله </th>
							<td class='col-md-10' > 
								@if ($faculty_level->is_active)
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