@extends('board.layout.master')

@section('page_title')
@lang('groups.show group details')
@endsection



@section('breadcrumb')
<a href="{{ route('board.groups.index') }}" class="breadcrumb-item"> @lang('groups.groups')</a>
<span class="breadcrumb-item active"> @lang('groups.show group details') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('groups.show group details') </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-3' >  @lang('dashboard.created at')  </th>
							<td class='col-md-9' > {{ $group->created_at }} <span class='text-muted' > {{ $group->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' >  @lang('dashboard.added by') </th>
							<td class='col-md-9' >{{ $group->user?->name }}  </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('groups.name') </th>
							<td class='col-md-9' > {{ $group->name }} </td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('groups.statrs_at') </th>
							<td class='col-md-9' > {{ $group->starts_at }} </td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('groups.ends_at') </th>
							<td class='col-md-9' > {{ $group->ends_at }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('groups.course') </th>
							<td class='col-md-9' > {{ $group->CourseTeacher?->course?->title }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('groups.teacher') </th>
							<td class='col-md-9' > {{ $group->CourseTeacher?->teacher?->name }} </td>
						</tr>
					
						<tr class='row' > 
							<th class='col-md-3' > @lang('groups.maxmimam student number') </th>
							<td class='col-md-9' > {{ $group->max_students_limit }} <span class='text-muted'> @lang('groups.students') </span> </td>
						</tr>

						<tr class='row' > 
							<th class='col-md-3' > @lang('groups.times') </th>
							<td class='col-md-9' > 
								<ul>
									@foreach ($times as $time)
										<li> {{ $time['day'] }} - {{ $time['start']->format('g:i') }} - {{ $time['end']->format('g:i') }} </li>
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

@endsection