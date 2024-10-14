@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.universities.index') }}" class="breadcrumb-item"> @lang('universities.universities') </a>
<span class="breadcrumb-item active"> تعديل الجامعه  </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> تعديل الجامعه  </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.universities.update' , $university ) }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> بيانات الجامعه </div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> اسم الجامعه بالعربيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_ar" value="{{ $university->getTranslation('name' , 'ar') }}" class="form-control @error('name_ar')  is-invalid @enderror" required placeholder="اسم الجامعه">
								@error('name_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> اسم الجامعه بالانجليزيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_en" value="{{ $university->getTranslation('name' , 'en') }}" class="form-control @error('name_en')  is-invalid @enderror" required placeholder="اسم الجامعه">
								@error('name_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> حاله الجامعه </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="active" {{ $university->is_active == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> فعال </span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.universities.index') }}' class="btn btn-light" id="reset"> تراجع </a>
					<button type="submit" class="btn btn-primary ms-3"> تعديل <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection