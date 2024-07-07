@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.questions.index') }}" class="breadcrumb-item"> @lang('questions.questions') </a>
<span class="breadcrumb-item active">  @lang('questions.add new question')  </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0">  @lang('questions.add new question')  </h5>
			</div>

			@livewire('board.questions.add-new-question')

		</div>
	</div>
</div>

@endsection

