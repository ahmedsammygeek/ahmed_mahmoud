@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.admins.index') }}" class="breadcrumb-item"> المشرفين </a>
<span class="breadcrumb-item active"> إضافه مشرف جديد </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> إضافه مشرف جديد </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.admins.store') }}">
				<div class="card-body">
					@csrf
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> بيانات المشرف </div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> اسم المشرف <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name')  is-invalid @enderror" required placeholder="اسم المشرف">
								@error('name')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> البريد الاكترونى <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<div class="input-group">
									<span class="input-group-text"><i class="icon-mention"></i></span>
									<input type="email" name="email" value='{{ old('email') }}' class="form-control @error('email')  is-invalid @enderror" required placeholder="البريد الاكترونى">
								</div>
								@error('email')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> كلمه المرور  <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="password" name="password" id="password" class="form-control" required placeholder="كلمه المرور">
								@error('password')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> تاكيد كلمه المرور <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="password" name="password_confirmation" class="form-control" required placeholder="تايد كلمه المرور">
								@error('password_confirmation')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> السماح بدخول النظام</label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="active" >
									<span class="form-check-label"> نعم </span>
								</label>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> @lang('admins.permissions') </label>
							<div class="col-lg-10">
								<div class="row">
									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('admins.admins') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new admin" id="dc_ls_u1">
											<label class="ms-2" for="dc_ls_u1"> @lang('permissions.add new admin') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all admins" id="dc_ls_u2">
											<label class="ms-2" for="dc_ls_u2">@lang('permissions.list all admins')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show all admins" id="show_admin_details">
											<label class="ms-2" for="show_admin_details">@lang('permissions.show all admins')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit admin details" id="dc_ls_u3">
											<label class="ms-2" for="dc_ls_u3">@lang('permissions.edit admin details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete admin" id="dc_ls_u4">
											<label class="ms-2" for="dc_ls_u4">@lang('permissions.delete admin')</label>
										</div>
									</div>
									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.slides') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new slide" id="dc_ls_u8">
											<label class="ms-2" for="dc_ls_u8"> @lang('permissions.add new slide') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show slides details" id="show_slide_details">
											<label class="ms-2" for="show_slide_details">@lang('permissions.show slides details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all slides" id="dc_ls_u9">
											<label class="ms-2" for="dc_ls_u9"> @lang('permissions.list all slides') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit slide details" id="dc_ls_u10">
											<label class="ms-2" for="dc_ls_u10">@lang('permissions.edit slide details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete slide" id="dc_ls_u11">
											<label class="ms-2" for="dc_ls_u11"> @lang('permissions.delete slide') </label>
										</div>
									</div>
									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.universities') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new university" id="dc_ls_u0">
											<label class="ms-2" for="dc_ls_u0"> @lang('permissions.add new university') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show university details" id="university_show_details">
											<label class="ms-2" for="university_show_details">@lang('permissions.show university details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all universities" id="dc_ls_u5">
											<label class="ms-2" for="dc_ls_u5"> @lang('permissions.list all universities') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit university details" id="dc_ls_u6">
											<label class="ms-2" for="dc_ls_u6">@lang('permissions.edit university details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete university" id="dc_ls_u7">
											<label class="ms-2" for="dc_ls_u7"> @lang('permissions.delete university') </label>
										</div>
									</div> 

								</div>
								<div class="row">
									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.faculties') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new faculty"  id="dc_ls_u12">
											<label class="ms-2" for="dc_ls_u12"> @lang('permissions.add new faculty') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show faculty details" id="faculty">
											<label class="ms-2" for="faculty">@lang('permissions.show faculty details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all faculties"  id="dc_ls_u13">
											<label class="ms-2" for="dc_ls_u13">@lang('permissions.list all faculties')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit faculty details"  id="dc_ls_u14">
											<label class="ms-2" for="dc_ls_u14">@lang('permissions.edit faculty details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete faculty"  id="dc_ls_u15">
											<label class="ms-2" for="dc_ls_u15">@lang('permissions.delete faculty')</label>
										</div>
									</div>
									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.faculty_levels') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new faculty level"  id="dc_ls_u16">
											<label class="ms-2" for="dc_ls_u16"> @lang('permissions.add new faculty level') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show faculty level details" id="faculty_level">
											<label class="ms-2" for="faculty_level">@lang('permissions.show faculty level details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all faculty_levels"  id="dc_ls_u17">
											<label class="ms-2" for="dc_ls_u17"> @lang('permissions.list all faculty_levels') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit faculty level details"  id="dc_ls_u18">
											<label class="ms-2" for="dc_ls_u18">@lang('permissions.edit faculty level details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete faculty level"  id="dc_ls_u19">
											<label class="ms-2" for="dc_ls_u19"> @lang('permissions.delete faculty level') </label>
										</div>
									</div>

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.teachers') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new teacher"  id="dc_ls_u16teacher">
											<label class="ms-2" for="dc_ls_u16teacher"> @lang('permissions.add new teacher') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show teacher details" id="faculty_level">
											<label class="ms-2" for="faculty_level">@lang('permissions.show teacher details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all teachers"  id="dc_ls_u17teacher">
											<label class="ms-2" for="dc_ls_u17teacher"> @lang('permissions.list all teachers') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit teacher details"  id="dc_ls_u18teacher">
											<label class="ms-2" for="dc_ls_u18teacher">@lang('permissions.edit teacher details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete teacher"  id="dc_ls_u19teacher">
											<label class="ms-2" for="dc_ls_u19teacher"> @lang('permissions.delete teacher') </label>
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.grades') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new grade"  id="dc_ls_u16grade">
											<label class="ms-2" for="dc_ls_u16grade"> @lang('permissions.add new grade') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show grade details" id="faculty_levelgrade">
											<label class="ms-2" for="faculty_levelgrade">@lang('permissions.show grade details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all grades"  id="dc_ls_u17grade">
											<label class="ms-2" for="dc_ls_u17grade"> @lang('permissions.list all grades') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit grade details"  id="dc_ls_u18grade">
											<label class="ms-2" for="dc_ls_u18grade">@lang('permissions.edit grade details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete grade"  id="dc_ls_u19grade">
											<label class="ms-2" for="dc_ls_u19grade"> @lang('permissions.delete grade') </label>
										</div>
									</div>
									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.educational systems') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new educational system"  id="dc_ls_u16educationalsystem">
											<label class="ms-2" for="dc_ls_u16educationalsystem"> @lang('permissions.add new educational system') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show educational system details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show educational system details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all educational systems"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all educational systems') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit educational system details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit educational system details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete educational system"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete educational system') </label>
										</div>
									</div>

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

									<div class="col-md-4">
										<label for="" class='mb-2'> @lang('permissions.announcements') </label>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="add new announcement"  id="announcements">
											<label class="ms-2" for="announcements"> @lang('permissions.add new announcement') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="show announcement details" id="faculty_leveleducationalsystem">
											<label class="ms-2" for="faculty_leveleducationalsystem">@lang('permissions.show announcement details')</label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="list all announcements"  id="dc_ls_u17educationalsystem">
											<label class="ms-2" for="dc_ls_u17educationalsystem"> @lang('permissions.list all announcements') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="edit announcement details"  id="dc_ls_u18educationalsystem">
											<label class="ms-2" for="dc_ls_u18educationalsystem">@lang('permissions.edit announcement details') </label>
										</div>
										<div class="d-flex align-items-center mb-2">
											<input type="checkbox" name="permissions[]" value="delete announcement"  id="dc_ls_u19educationalsystem">
											<label class="ms-2" for="dc_ls_u19educationalsystem"> @lang('permissions.delete announcement') </label>
										</div>
									</div>

								</div>



							</div>
						</div>
					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.admins.index') }}' class="btn btn-light" id="reset"> الغاء </a>
					<button type="submit" class="btn btn-primary ms-3"> إضافه <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection