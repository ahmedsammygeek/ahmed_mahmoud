@extends('board.layout.master')
@section('page_title' , ' تعديل بيانات الدرس' )

@section('breadcrumbs')
<a href="{{ route('board.courses.index') }}" class="breadcrumb-item"> الكورسات </a>
<a href="{{ route('board.courses.show' , $course ) }}" class="breadcrumb-item"> {{ $course->title }} </a>
<a href="{{ route('board.courses.units.index' , $course ) }}" class="breadcrumb-item"> الوحدات </a>
<a href="{{ route('board.courses.units.show' , [ 'course' => $course  , 'unit' => $unit ] ) }}" class="breadcrumb-item"> {{ $unit->title }} </a>
<span class="breadcrumb-item active"> تعديل بيانات الدرس </span>
@endsection

@section('page_content')
<div class="row">
	<div class="col-md-12">
		<a href="{{ route('board.courses.units.show' , ['course' => $course , 'unit' => $unit ] ) }}" class="btn btn-primary mb-2" style="float: left;margin-left:10px;">
			<span style='margin-left:10px' > العوده الى الوحده  </span>  <i class="icon-arrow-left7"></i>
		</a>
		<a href="{{ route('board.courses.show' , $course ) }}" class="btn btn-primary mb-2" style="float: left; margin-left:10px;">
			<span style='margin-left:10px' > العوده الى الكورس </span>  <i class="icon-arrow-left7"></i>
		</a>
		<a href='{{ route('board.courses.index'  ) }}' class="btn btn-primary mb-2" style="float: left;margin-left:  20px;">
			<span style='margin-left:10px' > العوده الى الكورسات </span> <i class="icon-arrow-left7 "></i>
		</a>

	</div>

	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> تعديل بيانات الدرس  </h5>
			</div>

			<form  method="POST" action="{{ route('board.courses.units.lessons.update' ,[ 'course' => $course  , 'unit' => $unit , 'lesson' => $lesson ] ) }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@method('PATCH')
					<div class="mb-4">
						<div class="fw-bold border-bottom pb-2 mb-3"> بيانات  الدرس </div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> عنوان الدرس بالعربيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="title_ar" value="{{ $lesson->getTranslation('title' , 'ar') }}" class="form-control @error('title_ar')  is-invalid @enderror" required >
								@error('title_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> عنوان الدرس بالانجليزيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="title_en" value="{{ $lesson->getTranslation('title' , 'en') }}" class="form-control @error('title_en')  is-invalid @enderror" required >
								@error('title_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> شرح الدرس بالعربيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<textarea name="description_ar" class='form-control ' cols="30" rows="10"> {{ $lesson->getTranslation('content' ,'ar') }} </textarea>
								@error('description_ar')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label col-lg-2"> شرح الدرس بالانجليزيه <span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<textarea name="description_en" class='form-control ' cols="30" rows="10"> {{ $lesson->getTranslation('content' ,'en') }} </textarea>
								@error('description_en')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-2">  عدد مرات المشاهده المسموح بها </label>
							<div class="col-lg-10">
								<input type="text" name="allowed_views" value="{{ $lesson->allowed_views }}" class="form-control @error('allowed_views')  is-invalid @enderror" required >
								@error('allowed_views')
								<p class='text-danger' > {{ $message }} </p>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> درس مجانى  </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="is_free" {{ $lesson->is_free == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> نعم </span>
								</label>
							</div>
						</div>



						<div class="row mb-3">
							<label class="col-lg-2 col-form-label pt-0"> السماح بالعرض </label>
							<div class="col-lg-10">
								<label class="form-check form-switch">
									<input type="checkbox" value='1' class="form-check-input" name="is_active" {{ $lesson->is_active == 1 ? 'checked' : '' }} >
									<span class="form-check-label"> نعم </span>
								</label>
							</div>
						</div>

	

					</div>
				</div>

				<div class="card-footer d-flex  justify-content-end">
					<a  href='{{ route('board.courses.units.lessons.index' , [ 'course' => $course  , 'unit' => $unit ] ) }}' class="btn btn-light" id="reset"> الغاء </a>
					<button type="submit" class="btn btn-primary ms-3"> تعديل <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection



@section('styles')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

<script type="text/javascript">
	$(document).ready(function() {


		FilePond.setOptions({
			server: {
				url: "{{ route('board.proccess_video_uploads') }}",
				headers: {
					'X-CSRF-TOKEN': "{{ @csrf_token() }}",
				}
			}
		});

    // Create the FilePond instance

		FilePond.create(document.querySelector('input[name="video"]'));





	});
</script>
@endsection
