@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.faculty_levels.index') }}" class="breadcrumb-item"> السنوات الدراسيه </a>
<span class="breadcrumb-item active"> تعديل بيانات  السنه الدراسيه </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> تعديل بيانات  السنه الدراسيه </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.faculty_levels.update' , $faculty_level ) }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> بيانات القسم </div>



						<div class="row mb-3">
							<label class="col-form-label col-lg-2">  الكليه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="faculty_id" class='form-control form-select' id="">
									@foreach ($faculties as $faculty)
									<option value="{{ $faculty->id }}" {{ $faculty->id == $faculty_level->faculty_id ? 'selected="selected"' : '' }} >  {{ $faculty->name }} </option>
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
								<input type="text" name="name_ar" value="{{ $faculty_level->getTranslation('name' , 'ar' ) }}" class="form-control @error('name_ar')  is-invalid @enderror" required placeholder=" الاسم بالعربيه">
								@error('name_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> الاسم بالانجليزيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_en" value="{{ $faculty_level->getTranslation('name' , 'en' ) }}" class="form-control @error('name_en')  is-invalid @enderror" required placeholder=" الاسم بالانجليزيه">
								@error('name_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						


						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> حاله القسم </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="active" {{ $faculty_level->is_active == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> فعال </span>
								</label>
							</div>
						</div>

					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.faculty_levels.index') }}' class="btn btn-light" id="reset"> الغاء </a>
					<button type="submit" class="btn btn-primary ms-3"> تعديل <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection