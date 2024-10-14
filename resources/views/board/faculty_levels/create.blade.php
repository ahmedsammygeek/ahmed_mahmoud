@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.faculty_levels.index') }}" class="breadcrumb-item"> السنوات الدراسيه </a>
<span class="breadcrumb-item active"> إضافه سنه دراسيه جديده </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> إضافه سنه دراسيه جديده </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.faculty_levels.store') }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> بيانات السنه الدراسيه </div>



						<div class="row mb-3">
							<label class="col-form-label col-lg-2">  الكليه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="faculty_id" class='form-control form-select' id="">
									@foreach ($faculties as $faculty)
										<option value="{{ $faculty->id }}"> {{ $faculty->name }} </option>
									@endforeach
								</select>
								@error('faculty_id')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>




						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> الاسم بالعربيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control @error('name_ar')  is-invalid @enderror" required placeholder="اسم القسم">
								@error('name_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> الاسم بالانجليزيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control @error('name_en')  is-invalid @enderror" required placeholder="اسم القسم">
								@error('name_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						

						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0">  الحاله </label>
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
					<a  href='{{ route('board.faculty_levels.index') }}' class="btn btn-light" id="reset"> الغاء </a>
					<button type="submit" class="btn btn-primary ms-3"> إضافه <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection