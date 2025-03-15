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

            <form class="" method="POST" action="{{ route('board.courses.store') }}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="mb-4">
                        <div class="fw-bold border-bottom pb-2 mb-3"> @lang('courses.course details') </div>

                        <div class="row mb-2">

                            <div class="col-md-3">
                                <label class="col-form-label col-lg-12"> @lang('courses.image')
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-12">
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                    <p class='text-danger'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-2">
                                <label class="col-form-label col-lg-12"> @lang('courses.teacher') <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select name="teacher_id" class='form-control form-select select'  id="">
                                        @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">    {{ $teacher->name }}  </option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                    <p class='text-danger'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label col-lg-12">  @lang('courses.educational system') <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select name="educational_system_id[]" class='form-control form-select select' multiple id="">
                                        <option value="">  </option>
                                        @foreach ($systems as $system)
                                        <option value="{{ $system->id }}">  {{ $system->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('educational_system_id')
                                    <p class='text-danger'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="col-form-label col-lg-12">  @lang('courses.grade') <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select name="grade" class='form-control form-select '  id="">
                                        <option value="">  </option>
                                        @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">  {{ $grade->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('grade')
                                    <p class='text-danger'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="col-form-label col-lg-12">  @lang('courses.title') [@lang('courses.arabic')]  <span   class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="title_ar" value="{{ old('title_ar') }}"   class="form-control @error('title_ar')  is-invalid @enderror" required
                                    placeholder="عنوان الكورس">
                                    @error('title_ar')
                                    <p class='text-danger'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label col-lg-12"> @lang('courses.title') [@lang('courses.english')]  <span  class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="title_en" value="{{ old('title_en') }}"  class="form-control @error('title_en')  is-invalid @enderror" required
                                    placeholder="عنوان الكورس">
                                    @error('title_en')
                                    <p class='text-danger'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>




                    <div class="row mb-3">
                        <label class="col-form-label col-lg-12"> @lang('courses.content') [@lang('courses.arabic')]   <span class="text-danger">*</span></label>
                        <div class="col-lg-12">
                            <textarea name="content_ar" id="arTextarea" class='form-control textarea' cols="30" rows="10">{{ old('content_ar') }}</textarea>
                            @error('content_ar')
                            <p class='text-danger'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-12"> @lang('courses.content') [@lang('courses.english')]   <span     class="text-danger">*</span></label>
                        <div class="col-lg-12">
                            <textarea name="content_en" id="enTextarea" class='form-control textarea' cols="30" rows="10">{{ old('content_en') }}</textarea>
                            @error('content_en')
                            <p class='text-danger'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>



                    <div class="row mb-3 ">
                        <div class="col-md-6">
                            <label class="col-form-label col-lg-12"> عدد المشاهدات للدرس   </label>
                            <div class="col-lg-12">
                                <input type="number" name="default_view_number"  class="form-control @error('default_view_number')  is-invalid @enderror" required
                                placeholder=''>
                                @error('default_view_number')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label col-lg-12"> رقم التواصل للاشتراك  </label>
                            <div class="col-lg-12">
                                <input type="text" name="contact_mobile"  class="form-control @error('contact_mobile')  is-invalid @enderror" required
                                placeholder=''>
                                @error('contact_mobile')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>




                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="col-form-label col-lg-12"> @lang('courses.price') <span class="text-danger">*</span>    </label>
                            <div class="col-lg-12">
                                <input type="number" name="price" value='{{ old('price') }}' class="form-control @error('price')  is-invalid @enderror" required
                                placeholder=''>
                                @error('price')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label class="col-lg-12 col-form-label "> عرض داخل الصفحه الرئيسيه </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input"
                                    name="show_in_home" checked="">
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-lg-12 col-form-label "> السماح بالاشتراك فى الكورس </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="active"
                                    checked="">
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="col-lg-12 col-form-label ">  الاشتراك المباشر فى الكورس </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="direct_register" >
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label col-lg-12"> طريقه عرض عدد الطلاب <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select name="students_count_status" class='form-control form-select'  id="">
                                    <option value="1"> عرض عدد الطلاب الحقيقى </option>
                                    <option value="2"> عرض عدد وهمى </option>
                                    <option value="3"> عدم عرض عدد الطلاب نهئى </option>
                                </select>
                                @error('students_count_status')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label col-lg-12"> عدد الطلاب الوهمى  </label>
                            <div class="col-lg-12">
                                <input type="number" name="fake_students_count" value='{{ old('fake_students_count') }}' class="form-control @error('fake_students_count')  is-invalid @enderror" placeholder=''>
                                @error('fake_students_count')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

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
<script src="https://cdn.tiny.cloud/1/ic4s7prz04qh4jzykmzgizzo1lize2ckglkcjr9ci9sgkbuc/tinymce/6/tinymce.min.js"
referrerpolicy="origin"></script>
<script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/form_select2.js') }}"></script>
<script>
    $(document).ready(function() {
                    // tinymce.init({
                    //     selector: '#enTextarea',
                    //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    // });
    });

    $(document).ready(function() {
                    // tinymce.init({
                    //     selector: '#arTextarea',
                    //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    //     language: 'ar'
                    // });
    });
</script>
@endsection
