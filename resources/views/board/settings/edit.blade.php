@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.settings.edit') }}" class="breadcrumb-item"> @lang('settings.settings') </a>
<span class="breadcrumb-item active"> @lang('settings.edit')  </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('settings.settings')  </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.settings.update' , $settings ) }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('settings.general settings') </div>
						
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('settings.allow virtual apps') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="allow_virtual_apps" {{ $settings->allow_virtual_apps == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> @lang('dashboard.yes') </span>
								</label>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('settings.force phone verification') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="force_phone_verification" {{ $settings->force_phone_verification == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> @lang('dashboard.yes') </span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.settings.edit') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.edit') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection