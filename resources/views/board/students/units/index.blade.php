@extends('board.layout.master')

@section('page_title')
@lang('courses.show course details')
@endsection

@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<a href="{{ route('board.students.show' , $student ) }}" class="breadcrumb-item"> {{ $student->name }} </a>
<a href="{{ route('board.students.courses.index' , ['student' => $student] ) }}" class="breadcrumb-item"> @lang('students.courses') </a>
<a href="{{ route('board.students.courses.show' , ['student' => $student , 'course' => $course ] ) }}" class="breadcrumb-item"> @lang('students.courses') </a>
<span class="breadcrumb-item active"> @lang('courses.course lessons') </span>
@endsection

@section('page_content')
<div class="navbar navbar-expand-lg border-bottom py-2">
    <div class="container-fluid">
        <ul class="nav navbar-nav flex-row flex-fill">
            <li class="nav-item me-1">
                <a href="{{ route('board.students.show' , $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded" >
                    <div class="d-flex align-items-center mx-lg-1">
                        <i class="ph-activity"></i>
                        <span class="d-none d-lg-inline-block ms-2"> @lang('students.student details') </span>
                    </div>
                </a>
            </li>

            <li class="nav-item me-1">
                <a href="{{ route('board.students.courses.index', $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded active" >
                    <div class="d-flex align-items-center mx-lg-1">
                        <i class="ph-calendar"></i>
                        <span class="d-none d-lg-inline-block ms-2">
                            @lang('students.courses')
                        </span>
                    </div>
                </a>
            </li>
            <li class="nav-item me-1">
                <a href="{{ route('board.students.exams.index' , $student ) }}"  class="navbar-nav-link navbar-nav-link-icon rounded" >
                    <div class="d-flex align-items-center mx-lg-1">
                        <i class="ph-calendar"></i>
                        <span class="d-none d-lg-inline-block ms-2">
                            @lang('students.exams')
                        </span>
                    </div>
                </a>
            </li>
            <li class="nav-item me-1">
                <a  href="{{ route('board.students.installments.index' , $student ) }}"  class="navbar-nav-link navbar-nav-link-icon rounded" >
                    <div class="d-flex align-items-center mx-lg-1">
                        <i class="ph-calendar"></i>
                        <span class="d-none d-lg-inline-block ms-2">
                            @lang('students.installments')
                        </span>
                    </div>
                </a>
            </li>
            <li class="nav-item me-1">
                <a href="{{ route('board.students.payments.index' , $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded">
                    <div class="d-flex align-items-center mx-lg-1">
                        <i class="ph-calendar"></i>
                        <span class="d-none d-lg-inline-block ms-2">
                            @lang('students.payments')
                        </span>
                    </div>
                </a>
            </li>
            <li class="nav-item me-1">
                <a href="{{ route('board.students.financial_reports.index' , $student ) }}" class="navbar-nav-link navbar-nav-link-icon rounded" >
                    <div class="d-flex align-items-center mx-lg-1">
                        <i class="ph-gear"></i>
                        <span class="d-none d-lg-inline-block ms-2"> تقارير الماليه للطالب </span>
                    </div>
                </a>
            </li>

            

        </ul>

    </div>
</div>
<!-- /profile navigation -->


<!-- Content area -->
<div class="content">
    @livewire('board.students.courses.list-all-student-course-units' , ['student' => $student , 'course' => $course  ] )
</div>
<!-- /content area -->
@endsection

