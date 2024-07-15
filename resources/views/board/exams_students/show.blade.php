@extends('board.layout.master')

@section('page_title')
@lang('exams.show exam details')
@endsection



@section('breadcrumb')
<a href="{{ route('board.exams.index') }}" class="breadcrumb-item"> @lang('exams.exams')</a>
<a href="{{ route('board.exams.show' , $exam_student->exam ) }}" class="breadcrumb-item">  {{ $exam_student->exam?->title }} </a>
<a href="{{ route('board.exams.students.index' , $exam_student->exam ) }}" class="breadcrumb-item"> @lang('exams.students')  </a>
<span class="breadcrumb-item active"> @lang('exams.show exam details') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('exams.show student exam details') </h5>
			</div>
			<div class='card-body' >
				<table  class='table table-responsive table-xs '>
					<tbody>
						<tr class='row' >
							<th class='col-md-3' >  @lang('exams.exam title') </th>
							<td class='col-md-9' > {{ $exam_student->exam?->name }}  </td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' >  @lang('exams.student') </th>
							<td class='col-md-9' > {{ $exam_student->student?->name }}  </td>
						</tr>
						<tr class='row'>
							<th class='col-md-3' >  @lang('exams.started at')  </th>
							<td class='col-md-9' > {{ $exam_student->started_at }} <span class='text-muted' > {{ $exam_student->started_at?->diffForHumans() }} </span> </td>
						</tr>
						<tr class='row'>
							<th class='col-md-3' >  @lang('exams.ended at')  </th>
							<td class='col-md-9' > {{ $exam_student->ended_at }} <span class='text-muted' > {{ $exam_student->ended_at?->diffForHumans() }} </span> </td>
						</tr>
						<tr class='row'>
							<th class='col-md-3' >  @lang('exams.duration')  </th>
							<td class='col-md-9' > {{ $exam_student->ended_at?->diffInMinutes($exam_student->started_at) }} </td>
						</tr>				
						<tr class='row' >
							<th class='col-md-3' >  @lang('exams.total_degree') </th>
							<td class='col-md-9' > {{ $exam_student->total_degree }}  </td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('exams.is finished') </th>
							<td class='col-md-9' > 
								@switch($exam_student->is_finished)
                                @case(0)
                                <span class='badge bg-danger' > @lang('dashboard.no') </span>
                                @break
                                @case(1)
                                <span class='badge bg-success' > @lang('dashboard.yes') </span>
                                @break
                                @endswitch
							</td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('exams.is marked') </th>
							<td class='col-md-9' > 
								@switch($exam_student->is_marked)
                                @case(0)
                                <span class='badge bg-danger' > @lang('dashboard.no') </span>
                                @break
                                @case(1)
                                <span class='badge bg-success' > @lang('dashboard.yes') </span>
                                @break
                                @endswitch
							</td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('exams.marked by') </th>
							<td class='col-md-9' > 
								{{ $exam_student->markedBy?->name }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('exams.show student exam answers') </h5>
			</div>
			<div class='card-body' >
				<table  class='table table-responsive table-xs '>
					<thead>
						<tr>
							<th> # </th>
							<th> @lang('exams.question') </th>
							<th> @lang('exams.student answer') </th>
							<th> @lang('exams.corrct answer') </th>
							<th> @lang('exams.degree') </th>
							<th> @lang('dashboard.options') </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($answers as $answer)
							

							@livewire('board.exams.student-exam-answer' , ['index' => $loop->index  , 'student_exam_answer' => $answer ] , key($answer->id)  )	

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

@endsection