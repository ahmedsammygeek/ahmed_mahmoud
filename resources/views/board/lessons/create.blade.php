@extends('board.layout.master')
@section('page_title' , ' إضافه درس جديد' )

@section('breadcrumb')
<a href="{{ route('board.courses.index') }}" class="breadcrumb-item"> الكورسات </a>
<a href="{{ route('board.courses.show' , $course ) }}" class="breadcrumb-item"> {{ $course->title }} </a>
<a href="{{ route('board.courses.units.index' , $course ) }}" class="breadcrumb-item"> الوحدات </a>
<a href="{{ route('board.courses.units.show' , [ 'course' => $course  , 'unit' => $unit ] ) }}" class="breadcrumb-item"> {{ $unit->title }} </a>
<span class="breadcrumb-item active"> إضافه درس جديد </span>
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
				<h5 class="mb-0"> إضافه درس جديد الى الوحده : {{ $unit->title }} </h5>
			</div>

			@livewire('board.courses.units.lessons.add-new-lesson' , ['unit' => $unit , 'course' => $course  ] )


		</div>
	</div>
</div>

@endsection


{{-- @section('styles')
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
@endsection --}}