@extends('board.layout.master')
@section('page_title')
@lang('courses.add new unit')
@endsection

@section('breadcrumb')
<a href="{{ route('board.courses.index') }}" class="breadcrumb-item"> @lang('courses.courses') </a>
<a href="{{ route('board.courses.show' , $course ) }}" class="breadcrumb-item"> {{ $course->title }} </a>
<a href="{{ route('board.courses.units.index' , $course ) }}" class="breadcrumb-item"> @lang('courses.units') </a>
<span class="breadcrumb-item active"> @lang('courses.add new unit') </span>
@endsection

@section('page_content')
<div class="row">
		<div class="col-md-12">
		<a href="{{ route('board.courses.show' , $course ) }}" class="btn btn-primary mb-2" style="float: left;">
			<span style='margin-left:10px' > @lang('courses.back to course') </span>  <i class="icon-arrow-left7"></i>
		</a>
		<a href='{{ route('board.courses.units.index' , $course ) }}' class="btn btn-primary mb-2" style="float: left;margin-left:  20px;">
			<span style='margin-left:10px' > @lang('courses.back to course units') </span> <i class="icon-arrow-left7 "></i>
		</a>
	</div>

	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('courses.add new unit') </h5>
			</div>

			<form  method="POST" action="{{ route('board.courses.units.store' , $course ) }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					<div class="mb-4">
					<div class="fw-bold border-bottom pb-2 mb-3"> @lang('courses.unit details') </div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('courses.title') [@lang('courses.arabic')]  <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control @error('title_ar')  is-invalid @enderror" required >
								@error('title_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('courses.title') [@lang('courses.english')]  <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="title_en" value="{{ old('title_en') }}" class="form-control @error('title_en')  is-invalid @enderror" required >
								@error('title_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('courses.status') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="is_active" checked="" >
									<span class="form-check-label"> نعم </span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer d-flex  justify-content-end">
					<a  href='{{ route('board.courses.units.index' , $course  ) }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
