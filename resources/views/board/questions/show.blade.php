@extends('board.layout.master')

@section('page_title')
@lang('questions.show question details')
@endsection



@section('breadcrumb')
<a href="{{ route('board.questions.index') }}" class="breadcrumb-item"> @lang('questions.questions')</a>
<span class="breadcrumb-item active"> @lang('questions.show question details') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('questions.show question details') </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-3' >  @lang('dashboard.created at')  </th>
							<td class='col-md-9' > {{ $question->created_at }} <span class='text-muted' > {{ $question->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' >  @lang('dashboard.added by') </th>
							<td class='col-md-9' >{{ $question->user?->name }}  </td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' >  @lang('questions.course') </th>
							<td class='col-md-9' >{{ $question->course?->title }}  </td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' >  @lang('questions.lesson') </th>
							<td class='col-md-9' >{{ $question->lesson?->title }}  </td>
						</tr>


						<tr class='row' >
							<th class='col-md-3' > @lang('questions.question') </th>
							<td class='col-md-9' > 
								@if ($question->type == 1)
									{{ $question->content }} 
								@else
								<img src="{{ Storage::url('questions/'.$question->content); }}" alt="">
								@endif
							</td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('questions.question type') </th>
							<td class='col-md-9' > 
								@switch($question->type)
								@case(1)
								<span class='badge bg-primary'> @lang('questions.text') </span>
								@break
								@case(2)
								<span class='badge bg-success'> @lang('questions.image') </span>
								@break
								@endswitch
							</td>
						</tr>
						<tr class='row' >
							<th class='col-md-3' > @lang('questions.answer_type') </th>
							<td class='col-md-9' > 
								@switch($question->answer_type)
								@case(1)
								<span class='badge bg-primary'> @lang('questions.choices') </span>
								@break
								@case(2)
								<span class='badge bg-success'> @lang('questions.content') </span>
								@break
								@endswitch
							</td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' > @lang('questions.active') </th>
							<td class='col-md-9' > 
								@switch($question->is_active)
								@case(1)
								<span class='badge bg-primary'> @lang('dashboard.yes') </span>
								@break
								@case(0)
								<span class='badge bg-danger'> @lang('dashboard.no') </span>
								@break
								@endswitch
							</td>
						</tr>

						<tr class='row' >
							<th class='col-md-3' >  @lang('questions.degree') </th>
							<td class='col-md-9' >{{ $question->degree }}  </td>
						</tr>

						@if ($question->answer_type == 1 )
							<tr class='row' > 
							<th class='col-md-3' > @lang('questions.times') </th>
							<td class='col-md-9' > 
								<ul>
									@foreach ($question->answers as $answer)
									<li> 
										{{ $answer->content }}  
										@if ($answer->is_correct_answer)
											<span class='icon-checkmark ' > </span>
										@else
										<span class='icon-cross3 ' >  </span>
										@endif
									 </li>
									@endforeach
								</ul>
							</td>
						</tr>
						@endif
						

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection