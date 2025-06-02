@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.missing_payments.index' ) }}" class="breadcrumb-item"> الحاسابات المفقوده </a>
<span class="breadcrumb-item active"> إضافه جديد </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> إضافه  جديد </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.students.missing_payments.store' , $student) }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> بيانات الصنف </div>

												<div class="row mb-3">
							<label class="col-form-label col-lg-2"> القسم <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="course_id" class='form-control form-select select'>
									@foreach ($courses as $course)
									<option value="{{ $course->id }}"> {{ $course->title }} </option>
									@endforeach
								</select>
								@error('course_id')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>



						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> المبلغ المدفوع <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="paid_amount" value="{{ old('paid_amount') }}" class="form-control @error('paid_amount')  is-invalid @enderror" required placeholder="المبلغ المدفوع">
								@error('paid_amount')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> المبلغ المتبقى <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="remains_amount" value="{{ old('remains_amount') }}" class="form-control @error('remains_amount')  is-invalid @enderror" required placeholder="المبلغ المتبقى">
								@error('remains_amount')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> ملاحظات </label>
							<div class="col-lg-10">
								<input type="text" name="notes" value="{{ old('notes') }}" class="form-control @error('notes')  is-invalid @enderror" required placeholder="ملاحظات خاصه بعمليه الدفع">
								@error('notes')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>



	
					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.items.index') }}' class="btn btn-light" id="reset"> الغاء </a>
					<button type="submit" class="btn btn-primary ms-3"> إضافه <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')
	<script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script>
	<script>
		$(function() {
			 $('.select').select2();
		});
	</script>
@endsection