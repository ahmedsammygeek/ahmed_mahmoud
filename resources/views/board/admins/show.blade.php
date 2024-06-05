@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.admins.index') }}" class="breadcrumb-item"> المشرفين </a>
<span class="breadcrumb-item active"> عرض بيانات المشرف </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> عرض بيانات المشرف </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-bordered table-responsive table-striped'>
					<tbody>
						<tr>
							<th> تاريخ الاضافه </th>
							<td> {{ $admin->created_at }} <span class='text-muted' > {{ $admin->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr>
							<th> الاسم </th>
							<td> {{ $admin->name }} </td>
						</tr>

						<tr>
							<th> البريد الاكترنى </th>
							<td> {{ $admin->email }} </td>
						</tr>

						<tr>
							<th> الصوره الشخصيه الحاليه </th>
							<td> <img class='img-responsive img-thumbnail' src="{{ Storage::url('users/'.$admin->image) }}" alt=""> </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection