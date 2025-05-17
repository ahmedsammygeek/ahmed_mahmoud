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
									<span class="form-check-label"> @lang('dashboard.activate') </span>
								</label>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('settings.force phone verification') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="force_phone_verification" {{ $settings->force_phone_verification == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> @lang('dashboard.activate') </span>
								</label>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('settings.allow developer mode') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="allow_developer_mode" {{ $settings->allow_developer_mode == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> @lang('dashboard.activate') </span>
								</label>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('settings.application form status') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="application_form_status" {{ $settings->application_form_status == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> @lang('dashboard.activate') </span>
								</label>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> يجب وضع رقم الوالدين </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="force_guardian_mobile" {{ $settings->force_guardian_mobile == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> @lang('dashboard.activate') </span>
								</label>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> عدد المشاهدات التلقائى للفديو </label>
							<div class="col-lg-10">
								<input type="number" value='{{ $settings->default_views_number }}' class="form-control" name="default_views_number"  >
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> عدد المشاهدات التلقائى للمكتبه </label>
							<div class="col-lg-10">
								<input type="number" value='{{ $settings->default_library_views_number }}' class="form-control" name="default_library_views_number"  >
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> تفعيل تطبيق الموبيل </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="access_api" {{ $settings->access_api == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> @lang('dashboard.activate') </span>
								</label>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> رساله الايقاف  </label>
							<div class="col-lg-10">
								<input type="text" value='{{ $settings->api_access_message }}' class="form-control" 
								name="api_access_message"  >
							</div>
							@error('api_access_message')
							<p class='text-danger'> {{ $message }} </p>
							@enderror	
						</div>

						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> عدد التنزيلات التلقائى للمكتبه </label>
							<div class="col-lg-10">
								<input type="number" value='{{ $settings->default_library_download_number }}' class="form-control" name="default_library_download_number"  >
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> عدد الدقائق لحساب المشاده </label>
							<div class="col-lg-10">
								<input type="number" value='{{ $settings->default_seen_mints }}' class="form-control" name="default_seen_mints"  >
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('settings.logo') </label>
							<div class="col-lg-10">
								<input type="file" value='1' class="form-control" name="logo"  >
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('settings.current logo') </label>
							<div class="col-lg-10">
								<img src="{{ Storage::url('settings/'.$settings->logo) }}" alt="">
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