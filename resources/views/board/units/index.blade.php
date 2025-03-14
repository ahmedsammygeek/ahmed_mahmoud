@extends('board.layout.master')

@section('page_title')
@lang('courses.show all units')
@endsection
@section('breadcrumb')
<a href="{{ route('board.courses.index') }}" class="breadcrumb-item"> @lang('courses.courses') </a>
<a href="{{ route('board.courses.show' , $course ) }}" class="breadcrumb-item"> {{ $course->title }} </a>
<a href="{{ route('board.courses.units.index' , $course ) }}" class="breadcrumb-item"> @lang('courses.units') </a>
<span class="breadcrumb-item active"> @lang('courses.show all units') </span>
@endsection

@section('page_content')
<div class="row">
	<div class="col-md-12">
		<a href="{{ route('board.courses.show' , $course ) }}" class="btn btn-primary mb-2" style="float: left;">
			<span style='margin-left:10px' > @lang('courses.back to course') </span>  <i class="icon-arrow-left7"></i>
		</a>

		<a href="{{ route('board.courses.units.create' , $course ) }}" class="btn btn-primary mb-2" style="float: left;margin-left:10px;">  <i class="icon-plus3  me-2"></i>  @lang('courses.add new unit') </a>



	</div>
	<div class="col-md-12">
		<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
			<li class="nav-item">
				<a href="{{ route('board.courses.show', $course) }}" class="nav-link "> 
					@lang('courses.course details')
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ route('board.courses.units.index', $course) }}" class="nav-link active"> 
				@lang('courses.units') 
				<span style="margin-right:10px;" class='badge bg-primary '> {{ $course->units()->count() }} </span>
			</a>
			</li>
			<li class="nav-item">
               <a href="{{ route('board.courses.students.index', $course) }}" class="nav-link"> الطلبه  <span style="margin-right:10px;" class='badge bg-primary '> {{ $course_students }} </span> </a>
            </li>
			<li class="nav-item">
				{{-- <a href="{{ route('board.courses.reviews', $course) }}" class="nav-link"> التقييمات</a> --}}
			</li>
			<li class="nav-item">
				{{-- <a href="{{ route('board.courses.installments.index', $course) }}" class="nav-link">الاقساط </a> --}}
			</li>
		</ul>
	</div>
</div>
<!-- Main charts -->

<div class="row">

	<div class="col-md-12">
		@livewire('board.courses.units.list-all-course-units' , ['course' => $course ] )
	</div>
</div>

@endsection

