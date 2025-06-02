@extends('board.layouts.master')


@section('breadcrumb')
<a href="{{ route('board.items.index') }}" class="breadcrumb-item"> الاصناف </a>
<span class="breadcrumb-item active"> تعديل بيانات الصنف </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> تعديل بيانات الصنف </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.items.update' , $item ) }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> بيانات الصنف </div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> صوره الصنف <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="file" name="image"  class="form-control @error('image')  is-invalid @enderror"  >
								@error('image')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> القسم <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<select name="category_id" class='form-control form-select select'>
									@foreach ($categories as $category)
									<option value="{{ $category->id }}" {{ $category->id == $item->category_id ? 'selected="selected"' : '' }} > {{ $category->name }} </option>
									@endforeach
								</select>
								@error('category_id')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>



						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> اسم الصنف بالعربيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_ar" value="{{ $item->getTranslation('name' , 'ar') }}" class="form-control @error('name_ar')  is-invalid @enderror" required placeholder="اسم الصنف">
								@error('name_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> اسم الصنف بالانجليزيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="name_en" value="{{ $item->getTranslation('name' , 'en') }}" class="form-control @error('name_en')  is-invalid @enderror" required placeholder="اسم الصنف">
								@error('name_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> عدد النقاط <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="points" value="{{ $item->points }}" class="form-control @error('points')  is-invalid @enderror" required placeholder="عدد نقاط الصنف عند الاستبدال">
								@error('points')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>



						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> حاله الصنف </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="active" {{ $item->is_active == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> فعال </span>
								</label>
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> صوره الصنف الحاليه </label>
							<div class="col-lg-10">
								<img class='img-thumbnail img-responsive' src="{{ Storage::url('items/'.$item->image) }}" alt="">
							</div>
						</div>

					</div>
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.items.index') }}' class="btn btn-light" id="reset"> الغاء </a>
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