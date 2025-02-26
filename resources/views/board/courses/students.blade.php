@extends('board.layout.master')

@section('page_title')
@lang('courses.show course details')
@endsection

@section('breadcrumb')
<a href="{{ route('board.courses.index') }}" class="breadcrumb-item"> @lang('courses.courses') </a>
<span class="breadcrumb-item active"> @lang('courses.show course details') </span>
@endsection

@section('page_content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('board.courses.index') }}" class="btn btn-primary mb-2 " style="float: left;">
            @lang('course.show all courses')
        </a>
    </div>
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
            <li class="nav-item">
                <a href="{{ route('board.courses.show', $course) }}" class="nav-link "> تفاصيل   الكورس   </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('board.courses.units.index', $course) }}" class="nav-link "> الوحدات <span style="margin-right:10px;" class='badge bg-primary '> {{ $course->units()->count() }} </span> </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('board.courses.students.index', $course) }}" class="nav-link active"> الطلبه  <span style="margin-right:10px;" class='badge bg-primary '> {{ $course->students()->count() }} </span> </a>
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

@livewire('board.courses.list-all-course-students' , ['course' => $course] )


@endsection


@section('scripts')
<script src="{{ asset('board_assets/js/vendor/media/glightbox.min.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/gallery.js') }}"></script>
@endsection
