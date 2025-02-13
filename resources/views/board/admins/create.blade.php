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
									<input checked="" type="checkbox" value='1' class="form-check-input" name="active" >
									<span class="form-check-label"> نعم </span>
								</label>
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
											<input checked="" type="checkbox" name="permissions[]" value="{{ $one_permission->name }}" id="dc_ls_u1{{ $one_permission->id }}">
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
					<a  href='{{ route('board.admins.index') }}' class="btn btn-light" id="reset"> الغاء </a>
					<button type="submit" class="btn btn-primary ms-3"> إضافه <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection