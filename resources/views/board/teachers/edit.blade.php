@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<span class="breadcrumb-item active"> @lang('students.edit student details') </span>
@endsection

@section('page_content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('students.edit student details') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.students.update' , $student ) }}">
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('students.student details') </div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.name') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name" value="{{ $student->name }}" class="form-control @error('name')  is-invalid @enderror" required placeholder="">
								@error('name')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.mobile') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="mobile" value="{{ old('mobile') ? old('mobile') : $student->mobile }}" class="form-control @error('mobile')  is-invalid @enderror" required placeholder="">
								@error('mobile')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.guardian mobile') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="guardian_mobile" value="{{ old('guardian_mobile') ? old('guardian_mobile') : $student->guardian_mobile }}" class="form-control @error('guardian_mobile')  is-invalid @enderror" required placeholder="">
								@error('guardian_mobile')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.grade') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="grade" class="form-control form-select" id="">
									@foreach ($grades as $grade)
									<option value="{{ $grade->id }}" @selected($grade->id == $student->grade_id ) > {{ $grade->name }} </option>
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
									<option value="{{ $system->id }}" @selected($system->id == $student->educational_system_id ) > {{ $system->name }} </option>
									@endforeach
								</select>
								@error('system')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('students.student type') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="student_type" wire:model.change='student_type' class="form-control form-select" id="">
									<option value="1" @selected($student->student_type == 1 )  > @lang('students.only center student') </option>
									<option value="2" @selected($student->student_type == 2 )  > @lang('students.only mobile student') </option>
									<option value="3" @selected($student->student_type == 3 )  > @lang('students.student can use both') </option>
								</select>
								@error('student_type')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.students.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.edit') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection