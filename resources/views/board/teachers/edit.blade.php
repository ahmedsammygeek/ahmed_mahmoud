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
									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.courses') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new course"  id="courses">
											<label class="ms-2" for="courses"> @lang('permissions.add new course') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show course details" id="faculty_leveleducationalsystem1">
											<label class="ms-2" for="faculty_leveleducationalsystem1">@lang('permissions.show course details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all courses"  id="dc_ls_u17educationalsystem2">
											<label class="ms-2" for="dc_ls_u17educationalsystem2"> @lang('permissions.list all courses') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit course details"  id="dc_ls_u18educationalsystem3">
											<label class="ms-2" for="dc_ls_u18educationalsystem3">@lang('permissions.edit course details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete course"  id="dc_ls_u19educationalsystem4">
											<label class="ms-2" for="dc_ls_u19educationalsystem4"> @lang('permissions.delete course') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.videos') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new video"  id="videos">
											<label class="ms-2" for="videos"> @lang('permissions.add new video') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show video details" id="faculty_leveleducationalsystem5">
											<label class="ms-2" for="faculty_leveleducationalsystem5">@lang('permissions.show video details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all videos"  id="dc_ls_u17educationalsystem6">
											<label class="ms-2" for="dc_ls_u17educationalsystem6"> @lang('permissions.list all videos') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit video details"  id="dc_ls_u18educationalsystem7">
											<label class="ms-2" for="dc_ls_u18educationalsystem7">@lang('permissions.edit video details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete video"  id="dc_ls_u19educationalsystem8">
											<label class="ms-2" for="dc_ls_u19educationalsystem8"> @lang('permissions.delete video') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.lessons') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new lesson"  id="lessons">
											<label class="ms-2" for="lessons"> @lang('permissions.add new lesson') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show lesson details" id="faculty_leveleducationalsystem10">
											<label class="ms-2" for="faculty_leveleducationalsystem10">@lang('permissions.show lesson details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all lessons"  id="dc_ls_u17educationalsystem11">
											<label class="ms-2" for="dc_ls_u17educationalsystem11"> @lang('permissions.list all lessons') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit lesson details"  id="dc_ls_u18educationalsystem12">
											<label class="ms-2" for="dc_ls_u18educationalsystem12">@lang('permissions.edit lesson details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete lesson"  id="dc_ls_u19educationalsystem13">
											<label class="ms-2" for="dc_ls_u19educationalsystem13"> @lang('permissions.delete lesson') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.units') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new unit"  id="units">
											<label class="ms-2" for="units"> @lang('permissions.add new unit') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show unit details" id="faculty_leveleducationalsystem14">
											<label class="ms-2" for="faculty_leveleducationalsystem14">@lang('permissions.show unit details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all units"  id="dc_ls_u17educationalsystem15">
											<label class="ms-2" for="dc_ls_u17educationalsystem15"> @lang('permissions.list all units') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit unit details"  id="dc_ls_u18educationalsystem16">
											<label class="ms-2" for="dc_ls_u18educationalsystem16">@lang('permissions.edit unit details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete unit"  id="dc_ls_u19educationalsystem17">
											<label class="ms-2" for="dc_ls_u19educationalsystem17"> @lang('permissions.delete unit') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.students') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new student"  id="students">
											<label class="ms-2" for="students"> @lang('permissions.add new student') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show student details" id="faculty_leveleducationalsystem18">
											<label class="ms-2" for="faculty_leveleducationalsystem18">@lang('permissions.show student details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all students"  id="dc_ls_u17educationalsystem19">
											<label class="ms-2" for="dc_ls_u17educationalsystem19"> @lang('permissions.list all students') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit student details"  id="dc_ls_u18educationalsystem20">
											<label class="ms-2" for="dc_ls_u18educationalsystem20">@lang('permissions.edit student details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete student"  id="dc_ls_u19educationalsystem21">
											<label class="ms-2" for="dc_ls_u19educationalsystem21"> @lang('permissions.delete student') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.groups') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new group"  id="groups">
											<label class="ms-2" for="groups"> @lang('permissions.add new group') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show group details" id="faculty_leveleducationalsystem22">
											<label class="ms-2" for="faculty_leveleducationalsystem22">@lang('permissions.show group details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all groups"  id="dc_ls_u17educationalsystem23">
											<label class="ms-2" for="dc_ls_u17educationalsystem23"> @lang('permissions.list all groups') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit group details"  id="dc_ls_u18educationalsystem24">
											<label class="ms-2" for="dc_ls_u18educationalsystem24">@lang('permissions.edit group details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete group"  id="dc_ls_u19educationalsystem25">
											<label class="ms-2" for="dc_ls_u19educationalsystem25"> @lang('permissions.delete group') </label>
										</div>
									</div>


									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.questions') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new question"  id="questions">
											<label class="ms-2" for="questions"> @lang('permissions.add new question') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show question details" id="faculty_leveleducationalsystem26">
											<label class="ms-2" for="faculty_leveleducationalsystem26">@lang('permissions.show question details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all questions"  id="dc_ls_u17educationalsystem27">
											<label class="ms-2" for="dc_ls_u17educationalsystem27"> @lang('permissions.list all questions') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit question details"  id="dc_ls_u18educationalsystem28">
											<label class="ms-2" for="dc_ls_u18educationalsystem28">@lang('permissions.edit question details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete question"  id="dc_ls_u19educationalsystem29">
											<label class="ms-2" for="dc_ls_u19educationalsystem29"> @lang('permissions.delete question') </label>
										</div>
									</div>


									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.exams') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new exam"  id="exams">
											<label class="ms-2" for="exams"> @lang('permissions.add new exam') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show exam details" id="faculty_leveleducationalsystem30">
											<label class="ms-2" for="faculty_leveleducationalsystem30">@lang('permissions.show exam details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all exams"  id="dc_ls_u17educationalsystem31">
											<label class="ms-2" for="dc_ls_u17educationalsystem31"> @lang('permissions.list all exams') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit exam details"  id="dc_ls_u18educationalsystem32">
											<label class="ms-2" for="dc_ls_u18educationalsystem32">@lang('permissions.edit exam details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete exam"  id="dc_ls_u19educationalsystem33">
											<label class="ms-2" for="dc_ls_u19educationalsystem33"> @lang('permissions.delete exam') </label>
										</div>
									</div>

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