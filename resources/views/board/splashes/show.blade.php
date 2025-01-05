@extends('board.layout.master')

@section('page_title')
@lang('exams.show exam details')
@endsection



@section('breadcrumb')
<a href="{{ route('board.exams.index') }}" class="breadcrumb-item"> @lang('exams.exams')</a>
<span class="breadcrumb-item active"> @lang('exams.show exam details') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('exams.show exam details') </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-3' >  @lang('dashboard.created at')  </th>
							<td class='col-md-9' > {{ $exam->created_at }} <span class='text-muted' > {{ $exam->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' >  @lang('dashboard.added by') </th>
							<td class='col-md-9' >{{ $exam->user?->name }}  </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('exams.title in arabic') </th>
							<td class='col-md-9' > {{ $exam->getTranslation('title' , 'ar' ) }} </td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('exams.title in english') </th>
							<td class='col-md-9' > {{ $exam->getTranslation('title' , 'en' ) }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('exams.course') </th>
							<td class='col-md-9' >{{ $exam->course?->title }}  </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('exams.starts at') </th>
							<td class='col-md-9' > {{ $exam->starts_at }} </td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('exams.ends at') </th>
							<td class='col-md-9' > {{ $exam->ends_at }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('exams.duration') </th>
							<td class='col-md-9' > {{ $exam->duration }} <span class='text-muted'> @lang('exams.minutes') </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('exams.pass degree') </th>
							<td class='col-md-9' > {{ $exam->pass_degree }} <span class='text-muted'> @lang('exams.degree') </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('exams.total degree') </th>
							<td class='col-md-9' > {{ $exam->total_degree }} <span class='text-muted'> @lang('exams.degree') </span> </td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('exams.question limit') </th>
							<td class='col-md-9' > {{ $exam->question_limit }} <span class='text-muted'> @lang('exams.question') </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('exams.total questions count') </th>
							<td class='col-md-9' > {{ $exam->questions()->count() }} <span class='text-muted'> @lang('exams.question') </span> </td>
						</tr>

					
					{{-- 	<tr class='row' > 
							<th class='col-md-3' > @lang('exams.maxmimam student number') </th>
							<td class='col-md-9' > {{ $exam->max_students_limit }} <span class='text-muted'> @lang('exams.students') </span> </td>
						</tr>
 --}}

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection