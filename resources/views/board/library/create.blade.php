@extends('board.layout.master')

@section('page_title')
@lang('library.add new file')
@endsection


@section('breadcrumb')
<a href="{{ route('board.library.index') }}" class="breadcrumb-item">  @lang('library.library')  </a>
<span class="breadcrumb-item active"> @lang('library.add new file') </span>
@endsection


@section('page_header')
<div class="page-header">
	<div class="page-header-content d-lg-flex">
		<div class="d-flex">
			<h4 class="page-title mb-0">
				@lang('dashboard.dashboard') - <span class="fw-normal"> @lang('library.library') </span>
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
				<h5 class="mb-0"> @lang('library.add new slide') </h5>
			</div>

			@livewire('board.library.add-new-file')
		</div>
	</div>
</div>

@endsection