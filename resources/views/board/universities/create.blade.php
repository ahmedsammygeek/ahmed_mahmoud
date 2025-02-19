@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.governorates.index') }}" class="breadcrumb-item"> @lang('universities.universities') </a>
<span class="breadcrumb-item active"> @lang('universities.add new university') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('universities.add new university') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.universities.store') }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> بيانات الجامعه </div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> اسم الجامعه بالعربيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control @error('name_ar')  is-invalid @enderror" required placeholder="اسم الجامعه بالعربيه">
								@error('name_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> اسم الجامعه بالانجليزيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control @error('name_en')  is-invalid @enderror" required placeholder="اسم الجامعه بالانجليزيه">
								@error('name_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> الكليات المرتبطه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="faculties[]" id="" class='form-control form-select' multiple="">
									@foreach ($faculties as $faculty)
										<option value="{{ $faculty->id }}"> {{ $faculty->name }} </option>
									@endforeach
								</select>
								@error('faculties')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> حاله الجامعه </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="active" checked="" >
									<span class="form-check-label"> فعال </span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.universities.index') }}' class="btn btn-light" id="reset"> الغاء </a>
					<button type="submit" class="btn btn-primary ms-3"> إضافه <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection