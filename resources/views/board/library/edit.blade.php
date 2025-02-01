@extends('board.layout.master')

@section('page_title')
@lang('slides.edit slide details')
@endsection


@section('breadcrumb')
<a href="{{ route('board.slides.index') }}" class="breadcrumb-item">  @lang('slides.slides')  </a>
<span class="breadcrumb-item active"> @lang('slides.edit slide details') </span>
@endsection


@section('page_header')
<div class="page-header">
	<div class="page-header-content d-lg-flex">
		<div class="d-flex">
			<h4 class="page-title mb-0">
				@lang('dashboard.dashboard') - <span class="fw-normal"> @lang('slides.slides') </span>
			</h4>
		</div>
	</div>
</div>
@endsection


@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('slides.edit slide details') </h5>
			</div>

			@livewire('board.library.edit-file' , ['lesson_file' => $library] )
		</div>
	</div>
</div>

@endsection