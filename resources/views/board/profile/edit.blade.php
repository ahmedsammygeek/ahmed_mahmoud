@extends('board.layout.master')


@section('breadcrumb')
<span class="breadcrumb-item active"> @lang('profile.edit details') </span>
@endsection

@section('page_content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('profile.edit details') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.profile.update') }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('profile.user details') </div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('profile.image') </label>
							<div class="col-lg-10">
								<input type="file" name="image"  class="form-control @error('image')  is-invalid @enderror"  placeholder="">
								@error('image')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('profile.name') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name')  is-invalid @enderror" required placeholder="">
								@error('name')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('profile.mobile') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="mobile" value="{{ old('mobile') ? old('mobile') : $user->mobile }}" class="form-control @error('mobile')  is-invalid @enderror" required placeholder="">
								@error('mobile')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('profile.email') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="email" value="{{ old('email') ? old('email') : $user->email }}" class="form-control @error('email')  is-invalid @enderror" required placeholder="">
								@error('email')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('profile.current password') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="password" name="current_password"  class="form-control @error('current_password')  is-invalid @enderror" required placeholder="">
								@error('current_password')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('profile.current image') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<img class="rounded-pill" width="200" height="200" src="{{ Storage::url('users/'.$user->image) }}" alt="">
							</div>
						</div>


					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.edit') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection