@extends('board.layout.master')

@section('page_title')
@lang('courses.edit course')
@endsection

@section('breadcrumb')
<a href="{{ route('board.students.index') }}" class="breadcrumb-item"> @lang('students.students') </a>
<a href="{{ route('board.students.show' , $student_course->student ) }}" class="breadcrumb-item"> {{ $student_course->student?->name }} </a>
<a href="{{ route('board.students.courses.index' , $student_course->student ) }}" class="breadcrumb-item"> @lang('students.courses') </a>
<span class="breadcrumb-item active"> @lang('courses.show course details') </span>
@endsection
@section('page_content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"> @lang('courses.edit course') </h5>
            </div>

            <form class="" method="POST" action="{{ route('board.students.courses.update' , ['student' => $student_course->student_id , 'course' => $student_course->course_id ] ) }}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <div class="fw-bold border-bottom pb-2 mb-3"> @lang('courses.course details') </div>

                        <div class="row mb-2">


                            <div class="col-md-6">
                                <label class="col-form-label col-lg-12"> @lang('courses.course') <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select name="teacher_id" class='form-control form-select select' disabled="" id="">  
                                        <option selected="selected">  {{ $student_course->course?->title }}  </option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <label class="col-form-label col-lg-12">  @lang('courses.group') <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select name="group_id" class='form-control form-select '  id="">
                                        <option value="">  </option>
                                        @foreach ($groups as $group)
                                        <option value="{{ $group->id }}" @selected($group->id == $student_course->group_id ) >  {{ $group->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('group_id')
                                    <p class='text-danger'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>





                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="col-lg-12 col-form-label "> @lang('courses.force headphons') </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input"  name="force_headphones" @checked($student_course->force_headphones) >
                                    <span class="form-check-label"> @lang('courses.yes')  </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-lg-12 col-form-label "> @lang('courses.allow') </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="allow"  @checked($student_course->allow) >
                                    <span class="form-check-label"> @lang('courses.yes')  </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-lg-12 col-form-label ">حضور المقر  </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="in_office"  @checked($student_course->in_office) >
                                    <span class="form-check-label"> @lang('courses.yes')  </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-lg-12 col-form-label "> عرض رقم الطالب </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input"  name="show_phone_on_viedo" @checked($student_course->show_phone_on_viedo) >
                                    <span class="form-check-label"> @lang('courses.yes')  </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-lg-12 col-form-label "> نطق رقم الطالب </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="speak_user_phone"  @checked($student_course->speak_user_phone) >
                                    <span class="form-check-label"> @lang('courses.yes')  </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-lg-12 col-form-label "> اجبار الوجه امام الكاميره </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input"  name="force_face_detecting" @checked($student_course->force_face_detecting) >
                                    <span class="form-check-label"> @lang('courses.yes')  </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-lg-12 col-form-label "> الاشتراك فى الورق من المقر  </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="office_library"  @checked($student_course->office_library) >
                                    <span class="form-check-label"> @lang('courses.yes')  </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-lg-12 col-form-label "> المكتبه الاكترونيه  </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="online_library"  @checked($student_course->online_library) >
                                    <span class="form-check-label"> @lang('courses.yes')  </span>
                                </label>
                            </div>
                        </div>

                    </div>




                </div>
           

            <div class="card-footer d-flex justify-content-end">
                <a href='{{ route('board.courses.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
                <button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.edit') <i  class="ph-paper-plane-tilt ms-2"></i></button>
            </div>
        </form>
    </div>
</div>
</div>

@endsection

