@extends('board.layout.master')

@section('page_title')
@lang('teachers.edit teacher')
@endsection

@section('breadcrumb')
<a href="{{ route('board.teachers.index') }}" class="breadcrumb-item"> @lang('teachers.teachers') </a>
<span class="breadcrumb-item active"> @lang('teachers.edit teacher') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('teachers.edit teacher') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.teachers.update' , $teacher ) }}"  enctype="multipart/form-data">
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('teachers.teacher details') </div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.name') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name" value="{{ $teacher->name }}" class="form-control @error('name')  is-invalid @enderror" required placeholder="">
								@error('name')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.mobile') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="mobile" value="{{ $teacher->mobile }}" class="form-control @error('mobile')  is-invalid @enderror" required placeholder="">
								@error('mobile')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.image') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="file" name="image"  class="form-control @error('image')  is-invalid @enderror"  placeholder="">
								@error('image')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.bio') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<textarea name="bio" class='form-control' row='4' cols="4" id="">{{ $teacher->bio }}</textarea>
								@error('bio')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teacher.show in suggested in mobile') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch mt-2">
									<input type="checkbox" value='1' class="form-check-input" name="show_in_suggested_in_app" {{ $teacher->show_in_suggested_in_app == 1 ? 'checked' : '' }}   >
									<span class="form-check-label"> نعم </span>
								</label>
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> عدد المشاهدات التلقائى للدرس <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="number" name="default_views_number" value="{{ $teacher->default_views_number }}" class="form-control @error('default_views_number')  is-invalid @enderror" placeholder="">
								@error('default_views_number')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2">  عدد المشاهدات التلقائى للمكتبه  <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="number" name="default_library_views_number" value="{{ $teacher->default_library_views_number }}" class="form-control @error('default_library_views_number')  is-invalid @enderror" placeholder="">
								@error('default_library_views_number')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2">  عدد التنزيلات التلقائى للمكتبه  <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="number" name="default_library_download_number" value="{{ $teacher->default_library_download_number }}" class="form-control @error('default_library_download_number')  is-invalid @enderror" placeholder="">
								@error('default_library_download_number')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 mt-4">
								<div class="form-check form-switch  mb-2 center-block ">
									<input type="checkbox" class="form-check-input" name='force_face_detecting' id="sc_lss_c"  {{ $teacher->force_face_detecting == 1 ? 'checked' : '' }}>
									<label class=""> استخدام الوجه المام الكاميره </label>
								</div>
							</div>


							<div class="col-sm-3 mt-4">
								<div class="form-check form-switch  mb-2 center-block ">
									<input type="checkbox" class="form-check-input" name='speak_user_phone' id="sc_lss_c"  {{ $teacher->speak_user_phone == 1 ? 'checked' : '' }}>
									<label class=""> نطق رقم الطالب </label>
								</div>
							</div>


							<div class="col-sm-3 mt-4">
								<div class="form-check form-switch  mb-2 center-block ">
									<input type="checkbox" class="form-check-input" name='show_phone_on_viedo' id="sc_lss_c"  {{ $teacher->show_phone_on_viedo == 1 ? 'checked' : '' }}>
									<label class=""> اظهار رقم الطالب على الفديو </label>
								</div>
							</div>



							<div class="col-sm-3 mt-4">
								<div class="form-check form-switch  mb-2 center-block ">
									<input type="checkbox" class="form-check-input" name='force_headphones' id="sc_lss_c"  {{ $teacher->force_headphones == 1 ? 'checked' : '' }}>
									<label class=""> اجبار السمعات </label>
								</div>
							</div>

							<div class="col-sm-3 mt-4">
								<div class="form-check form-switch  mb-2 center-block ">
									<input type="checkbox" class="form-check-input" name='force_water_mark' id="sc_lss_c"  {{ $teacher->force_water_mark == 1 ? 'checked' : '' }}>
									<label class=""> العلامه المائيه داخل المكتبه </label>
								</div>
							</div>


							<div class="col-sm-3 mt-4">
								<div class="form-check form-switch  mb-2 center-block ">
									<input type="checkbox" class="form-check-input" name='allow_download' id="sc_lss_c"  {{ $teacher->allow_download == 1 ? 'checked' : '' }}>
									<label class=""> السماح بالتحميل داخل المكتبه </label>
								</div>
							</div>

						</div>



						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.image') </label>
							<div class="col-lg-10">
								<img class="img-responsive img-thumbnail" src="{{ Storage::url('teachers/'.$teacher->image) }}" alt="">
							</div>
						</div>




						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('teachers.login details') </div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.password')  <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="password" name="password" id="password" class="form-control" >
								@error('password')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2">  @lang('teachers.password confirmation') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="password" name="password_confirmation" class="form-control" >
								@error('password_confirmation')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('admins.permissions') </label>
							<div class="col-lg-10">
								<div class="row">
									@foreach ($permissions as $permission)
									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('admins.'.$permission->first()?->group_name) </label>
										@foreach ($permission as $one_permission)
										<div class="d-flex align-items-center mb-2">
											<input  type="checkbox" name="permissions[]" value="{{ $one_permission->name }}" id="dc_ls_u1{{ $one_permission->id }}" {{ in_array($one_permission->name, $user_permissions) ? 'checked' : '' }} >
											<label class="ms-2" for="dc_ls_u1{{ $one_permission->id }}"> @lang('permissions.'.$one_permission->name) </label>
										</div>
										@endforeach
									</div>
									@endforeach
								</div>

							</div>
						</div>
						

					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.teachers.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.edit') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection