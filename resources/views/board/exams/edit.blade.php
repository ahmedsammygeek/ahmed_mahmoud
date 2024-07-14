@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.exams.index') }}" class="breadcrumb-item"> العلامات التجاريه </a>
<span class="breadcrumb-item active"> تعديل  العلامه التجاريه </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> تعديل  العلامه التجاريه </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.exams.update' , $exam ) }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> بيانات العلامه </div>

{{-- 

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> الصنف <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="item_id" class='form-control form-select select '>
									@foreach ($items as $item)
									<option value="{{ $item->id }}" {{ $brand->product_id == $item->id ? 'selected="selected"' : '' }} > {{ $item->name }} </option>
									@endforeach
								</select>
								@error('item_id')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>



						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> اسم العلامه بالعربيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_ar" value="{{ $brand->getTranslation('name' , 'ar') }}" class="form-control @error('name_ar')  is-invalid @enderror" required placeholder="اسم العلامه بالعربيه">
								@error('name_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> اسم العلامه بالانجليزيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_en" value="{{ $brand->getTranslation('name' , 'en') }}" class="form-control @error('name_en')  is-invalid @enderror" required placeholder="اسم العلامه بالانجليزيه">
								@error('name_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> حاله العلامه </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="active" {{ $brand->is_active == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> فعال </span>
								</label>
							</div>
						</div> --}}
					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.exams.index') }}' class="btn btn-light" id="reset"> الغاء </a>
					<button type="submit" class="btn btn-primary ms-3"> تعديل <i class="ph-paper-plane-tilt ms-2"></i></button>
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