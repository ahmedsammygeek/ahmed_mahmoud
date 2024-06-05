@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.slides.index') }}" class="breadcrumb-item"> عارض الصور </a>
<span class="breadcrumb-item active"> عرض بيانات الصوره </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> عرض بيانات الصوره </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-bordered table-responsive table-striped'>
					<tbody>
						<tr>
							<th> تاريخ الاضافه </th>
							<td> {{ $slide->created_at }} <span class='text-muted' > {{ $slide->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr>
							<th> تم الاضافه بواسطه </th>
							<td> {{ $slide->user?->name }} </td>
						</tr>

						<tr>
							<th> ترتيب العرض </th>
							<td> {{ $slide->order }} </td>
						</tr>

						<tr>
							<th> ترتيب العرض </th>
							<td> 
								@if ($slide->is_active)
								<span class='badge bg-success fs-sm ' > فعال</span>
								@else
								<span class='badge bg-danger fs-sm ' > غير فعال </span>
								@endif
							</td>
						</tr>

						<tr>
							<th> الصوره الشخصيه الحاليه </th>
							<td> <img class='img-responsive img-thumbnail' src="{{ Storage::url('slides/'.$slide->image) }}" alt=""> </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection