@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.slides.index') }}" class="breadcrumb-item"> @lang('slides.slides') </a>
<span class="breadcrumb-item active"> @lang('slides.show all slides')  </span>
@endsection

@section('page_header')
<div class="page-header">
	<div class="page-header-content d-lg-flex">
		<div class="d-flex">
			<h4 class="page-title mb-0">
				@lang('dashboard.dashboard') - <span class="fw-normal"> @lang('slides.slides') </span>
			</h4>

			<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
				<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
			</a>
		</div>

		<div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
			
		</div>
	</div>
</div>
@endsection


@section('page_content')

@livewire('board.slides.list-all-slides')

@endsection

