@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.teachers.index') }}" class="breadcrumb-item"> @lang('teachers.teachers') </a>
<span class="breadcrumb-item active"> @lang('teachers.show teacher details') </span>
@endsection

@section('page_content')


<!-- Content area -->
<div class="content">

	<!-- Inner container -->
	<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">

		<!-- Left content -->
		<div class="tab-content flex-fill order-2 order-lg-1">
			<div class="tab-pane fade active show " id="teacher_details">

				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header bg-primary text-white">
								<h5 class="mb-0">  @lang('teachers.show teacher details') </h5>
							</div>

							<div class='card-body' >
								<table  class='table table-bordered table-responsive table-striped'>
									<tbody>
										<tr>
											<th> @lang('dashboard.created at') </th>
											<td>{{ $teacher->created_at }}<span class='text-muted'>{{ $teacher->created_at->diffForHumans() }} </span> </td>
										</tr>
										<tr>
											<th> @lang('dashboard.added by') </th>
											<td> 
												<p> {{ $teacher->user?->name }} </p>
											</td>
										</tr>
										<tr>
											<th> @lang('teachers.name') </th>
											<td> {{ $teacher->name }} </td>
										</tr>

										<tr>
											<th>  @lang('teachers.mobile') </th>
											<td> {{ $teacher->mobile }} </td>
										</tr>
										<tr>
											<th>  @lang('teachers.bio') </th>
											<td> {{ $teacher->bio }} </td>
										</tr>

										<tr>
											<th>  @lang('teachers.show in suggested in mobile') </th>
											<td> 
												@if ($teacher->show_in_suggested_in_app)
												<span class="badge bg-primary"> @lang('teachers.yes') </span>
												@else
												<span class="badge bg-danger"> @lang('teachers.no') </span>
												@endif
											</td>
										</tr>
										<tr>
											<th>  @lang('teachers.is banned') </th>
											<td> 
												@if ($teacher->is_banned)
												<span class="badge bg-danger"> @lang('teachers.yes') </span>
												<br>
												<span> {{ $teacher->banning_message }} </span>
												@else
												<span class="badge bg-primary"> @lang('teachers.no') </span>
												@endif
											</td>
										</tr>


										<tr>
											<th>  @lang('teachers.courses') </th>
											<td> 
												<ul>
													@foreach ($teacher->courses as $teacher_course)
														<li> {{ $teacher_course->title }} </li>
													@endforeach
												</ul>
											</td>
										</tr>


									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>


			</div>

{{-- 			<div class="tab-pane fade " id="courses">
				@livewire('board.teachers.list-all-teacher-courses' , ['teacher' => $teacher] )
			</div>

			<div class="tab-pane fade" id="settings">



			</div> --}}
		</div>
		<!-- /left content -->




	</div>
	<!-- /inner container -->

</div>
<!-- /content area -->
@endsection

