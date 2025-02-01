@extends('board.layout.master')

@section('page_title')
@lang('teachers.add new teacher')
@endsection

@section('breadcrumb')
<a href="{{ route('board.teachers.index') }}" class="breadcrumb-item"> @lang('teachers.teachers') </a>
<span class="breadcrumb-item active"> @lang('teachers.add new teacher') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('teachers.add new teacher') </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.teachers.store') }}"  enctype="multipart/form-data">
				<div class="card-body">
					@csrf
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> @lang('teachers.teacher details') </div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.name') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name')  is-invalid @enderror" required placeholder="">
								@error('name')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.mobile') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile')  is-invalid @enderror" required placeholder="">
								@error('mobile')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.image') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="file" name="image"  class="form-control @error('image')  is-invalid @enderror" required placeholder="">
								@error('image')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teachers.bio') <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<textarea name="bio" class='form-control' row='4' cols="4" id=""></textarea>
								@error('bio')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> @lang('teacher.show in suggested in mobile') </label>
							<div class="col-lg-10">
								<label class="form-check form-switch mt-2">
									<input type="checkbox" value='1' class="form-check-input" name="show_in_suggested_in_app"   >
									<span class="form-check-label"> نعم </span>
								</label>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> عدد المشاهدات التلقائى للدرس <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="number" name="default_views_number" value="{{ old('default_views_number') }}" class="form-control @error('default_views_number')  is-invalid @enderror" placeholder="">
								@error('default_views_number')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
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

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.courses') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new course"  id="courses">
											<label class="ms-2" for="courses"> @lang('permissions.add new course') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show course details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show course details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all courses"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all courses') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit course details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit course details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete course"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete course') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.videos') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new video"  id="videos">
											<label class="ms-2" for="videos"> @lang('permissions.add new video') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show video details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show video details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all videos"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all videos') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit video details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit video details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete video"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete video') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.lessons') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new lesson"  id="lessons">
											<label class="ms-2" for="lessons"> @lang('permissions.add new lesson') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show lesson details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show lesson details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all lessons"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all lessons') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit lesson details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit lesson details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete lesson"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete lesson') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.units') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new unit"  id="units">
											<label class="ms-2" for="units"> @lang('permissions.add new unit') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show unit details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show unit details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all units"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all units') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit unit details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit unit details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete unit"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete unit') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.students') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new student"  id="students">
											<label class="ms-2" for="students"> @lang('permissions.add new student') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show student details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show student details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all students"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all students') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit student details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit student details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete student"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete student') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.groups') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new group"  id="groups">
											<label class="ms-2" for="groups"> @lang('permissions.add new group') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show group details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show group details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all groups"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all groups') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit group details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit group details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete group"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete group') </label>
										</div>
									</div>


									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.questions') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new question"  id="questions">
											<label class="ms-2" for="questions"> @lang('permissions.add new question') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show question details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show question details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all questions"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all questions') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit question details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit question details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete question"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete question') </label>
										</div>
									</div>


									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.exams') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new exam"  id="exams">
											<label class="ms-2" for="exams"> @lang('permissions.add new exam') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show exam details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show exam details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all exams"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all exams') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit exam details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit exam details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete exam"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete exam') </label>
										</div>
									</div>

								</div>



							</div>
						</div>
						

					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.teachers.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection