@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.educational_systems.index') }}" class="breadcrumb-item"> @lang('educational_systems.educational systems') </a>
<span class="breadcrumb-item active"> @lang('educational_systems.edit educational system details') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('educational_systems.edit educational system details') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.educational_systems.update' , $educational_system ) }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('educational_systems.educational system details') </div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('educational_systems.name in arabic') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_ar" value="{{ $educational_system->getTranslation('name' , 'ar' ) }}" class="form-control @error('name_ar')  is-invalid @enderror" required placeholder="">
								@error('name_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('educational_systems.name in english ') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_en" value="{{ $educational_system->getTranslation('name' , 'en' ) }}" class="form-control @error('name_en')  is-invalid @enderror" required placeholder="">
								@error('name_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('dashboard.active') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="active" {{ $educational_system->is_active == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> @lang('dashboard.yes') </span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.educational_systems.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.edit') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
