@extends('board.layout.master')

@section('page_title')
@lang('courses.add new course')
@endsection

@section('breadcrumbs')
<a href="{{ route('board.courses.index') }}" class="breadcrumb-item"> @lang('courses.courses') </a>
<span class="breadcrumb-item active"> @lang('courses.add new course') </span>
@endsection
@section('page_content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"> @lang('courses.add new course') </h5>
            </div>

            <form class="" method="POST" action="{{ route('board.courses.students.create.step_two.store') }}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="mb-4">
                        <div class="fw-bold border-bottom pb-2 mb-3"> @lang('courses.course details') </div>

                        <table class="table">

                            <thead>
                                <tr>
                                    <th>الماده</th>
                                    <th> الاقسام </th>
                                    <th> المجموعه </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($courses as $course)
                                <tr>
                                    <td>
                                        <select name="courses[{{ $course->id }}]" class='form-control'  >
                                            <option value="{{ $course->id }}"> {{ $course->title }} </option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input type="checkbox" class="form-check-input" checked>
                                            </div>

                                            <select class="form-control multiselect" name='units[{{ $course->id }}][]' multiple="multiple" required >
                                                @foreach ($course->units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('units.['.$course->id.'].*')
                                        <p class="text-danger"> {{ $message }} </p>
                                        @enderror
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <select class="form-control" name="groups[{{ $course->id }}]"  >
                                                @foreach ($course->groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
 
                                <tr>
                                    <td>
                                        <div class="form-check form-switch  mb-2 center-block ">
                                            <input type="checkbox" class="form-check-input" id="sc_lss_c" name="online_library[{{ $course->id }}]" checked="">
                                            الاشتراك بالمكتبه الاكترونيه
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        @foreach ($students as $student)
                        <input type="hidden" name="students[]" value="{{ $student }}" >
                        @endforeach

                    </div>








                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <a href='{{ route('board.courses.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
                <button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.add') <i  class="ph-paper-plane-tilt ms-2"></i></button>
            </div>
        </form>
    </div>
</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('board_assets/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/form_multiselect.js') }}"></script>
@endsection
