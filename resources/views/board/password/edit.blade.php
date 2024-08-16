@extends('board.layout.master')


@section('breadcrumb')
<span class="breadcrumb-item active"> @lang('profile.change password') </span>
@endsection

@section('page_content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('profile.change password') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.password.update') }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('profile.password details') </div>



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
							<label class="col-form-label col-lg-2"> @lang('profile.new password') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="password" name="password"  class="form-control @error('password')  is-invalid @enderror" required placeholder="">
								@error('password')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>



						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('profile.password confirmation') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="password" name="password_confirmation"  class="form-control @error('password_confirmation')  is-invalid @enderror" required placeholder="">
								@error('password_confirmation')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
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