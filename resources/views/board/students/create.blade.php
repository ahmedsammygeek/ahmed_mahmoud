@extends('board.layout.master')

@section('page_title')
@lang('students.add new student')
@endsection

@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<span class="breadcrumb-item active"> @lang('students.add new student') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('students.add new student') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.students.store') }}">
				<div class="card-body">
					@csrf
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('students.student details') </div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.name') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name')  is-invalid @enderror" required placeholder="">
								@error('name')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.mobile') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile')  is-invalid @enderror" required placeholder="">
								@error('mobile')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.guardian mobile') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="guardian_mobile" value="{{ old('guardian_mobile') }}" class="form-control @error('guardian_mobile')  is-invalid @enderror" required placeholder="">
								@error('guardian_mobile')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>



						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.password')  <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="password" name="password" id="password" class="form-control" required placeholder="">
								@error('password')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2">  @lang('students.password confirmation') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="password" name="password_confirmation" class="form-control" required placeholder="">
								@error('password_confirmation')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.grade') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="grade" class="form-control form-select" id="">
									@foreach ($grades as $grade)
									<option value="{{ $grade->id }}"> {{ $grade->name }} </option>
									@endforeach
								</select>
								@error('grade')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.educational system') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="educational_system_id" class="form-control form-select" id="">
									@foreach ($systems as $system)
									<option value="{{ $system->id }}"> {{ $system->name }} </option>
									@endforeach
								</select>
								@error('system')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('students.status') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="active" >
									<span class="form-check-label"> @lang('students.yes') </span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.students.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection