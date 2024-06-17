@extends('board.layout.master')

@section('page_title')
@lang('slides.add new slide')
@endsection


@section('breadcrumb')
<a href="{{ route('board.slides.index') }}" class="breadcrumb-item">  @lang('slides.slides')  </a>
<span class="breadcrumb-item active"> @lang('slides.add new slide') </span>
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
				<h5 class="mb-0"> @lang('slides.add new slide') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.slides.store') }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('slides.slide details') </div>

						<div class="row">
							<div class="col-md-4">
								<div class=" mb-3">
									<label class="col-form-label col-lg-12"> @lang('slides.image') <span class="text-danger">*</span></label>
									<div class="col-lg-12">
										<input type="file" name="image"  class="form-control @error('image')  is-invalid @enderror" >
										@error('image')
										<p class='text-danger' > {{ $message }} </p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class=" mb-3">
									<label class="col-form-label col-lg-12">  @lang('slides.sort') </label>
									<div class="col-lg-12">
										<input type="number" name="sort"  class="form-control"  placeholder="1">
										@error('order')
										<p class='text-danger' > {{ $message }} </p>
										@enderror
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class=" mb-3">
									<label class="col-lg-12 col-form-label "> @lang('slides.status') </label>
									<div class="col-lg-12">
										<label class="form-check form-switch">
											<input type="checkbox" value='1' class="form-check-input" name="active" checked="" >
											<span class="form-check-label"> @lang('slides.active') </span>
										</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class=" mb-3">
									<label class="col-form-label col-lg-12">  @lang('slides.title') [@lang('slides.arabic')] </label>
									<div class="col-lg-12">
										<input type="text" name="title_ar"  class="form-control"  placeholder="">
										@error('order')
										<p class='text-danger' > {{ $message }} </p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class=" mb-3">
									<label class="col-form-label col-lg-12">  @lang('slides.title') [@lang('slides.english')] </label>
									<div class="col-lg-12">
										<input type="text" name="title_en"  class="form-control"  placeholder="">
										@error('order')
										<p class='text-danger' > {{ $message }} </p>
										@enderror
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class=" mb-3">
									<label class="col-form-label col-lg-12">  @lang('slides.subtitle') [@lang('slides.arabic')] </label>
									<div class="col-lg-12">
										<input type="text" name="subtitle_ar"  class="form-control"  placeholder="">
										@error('order')
										<p class='text-danger' > {{ $message }} </p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class=" mb-3">
									<label class="col-form-label col-lg-12">  @lang('slides.subtitle') [@lang('slides.english')] </label>
									<div class="col-lg-12">
										<input type="text" name="subtitle_en"  class="form-control"  placeholder="">
										@error('order')
										<p class='text-danger' > {{ $message }} </p>
										@enderror
									</div>
								</div>
							</div>
						</div>
						


					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.slides.index') }}' class="btn btn-light" id="reset"> @lang('slides.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('slides.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection