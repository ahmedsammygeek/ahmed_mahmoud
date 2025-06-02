@extends('board.layout.master')

@section('page_title')
@lang('courses.edit course')
@endsection

@section('breadcrumbs')
<a href="{{ route('board.courses.index') }}" class="breadcrumb-item"> @lang('courses.courses') </a>
<span class="breadcrumb-item active"> @lang('courses.edit course') </span>
@endsection
@section('page_content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"> @lang('courses.edit course') </h5>
            </div>

            <form class="" method="POST" action="{{ route('board.courses.update' , $course ) }}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <div class="fw-bold border-bottom pb-2 mb-3"> @lang('courses.course details') </div>

                        <div class="row mb-2">

                            <div class="col-md-3">
                                <label class="col-form-label col-lg-12"> @lang('courses.image')  <span class="text-danger">*</span>   </label>
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
                                    <select name="teacher_id" class='form-control form-select select' id="">
                                        @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" @selected( $teacher->id == $course->teacher_id)  >    {{ $teacher->name }}  </option>
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
                                        <option value="{{ $system->id }}" @selected(in_array($system->id, $course_educational_systems)) >  {{ $system->name }} </option>
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
                                        <option value="{{ $grade->id }}" @selected($grade->id == $course->grade_id ) >  {{ $grade->name }} </option>
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
                                    <input type="text" name="title_ar" value="{{ $course->getTranslation('title'  , 'ar' ) }}"   class="form-control @error('title_ar')  is-invalid @enderror" required
                                    placeholder="عنوان الكورس">
                                    @error('title_ar')
                                    <p class='text-danger'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label col-lg-12"> @lang('courses.title') [@lang('courses.english')]  <span  class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="title_en" value="{{ $course->getTranslation('title'  , 'en' ) }}"  class="form-control @error('title_en')  is-invalid @enderror" required
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
                            <textarea name="content_ar" id="arTextarea" class='form-control textarea' cols="30" rows="10">{{ $course->getTranslation('content' , 'ar' ) }}</textarea>
                            @error('content_ar')
                            <p class='text-danger'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-12"> @lang('courses.content') [@lang('courses.english')]   <span     class="text-danger">*</span></label>
                        <div class="col-lg-12">
                            <textarea name="content_en" id="enTextarea" class='form-control textarea' cols="30" rows="10">{{ $course->getTranslation('content' , 'en' ) }}</textarea>
                            @error('content_en')
                            <p class='text-danger'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>




                    <div class="row mb-3 ">
                        <div class="col-md-6">
                            <label class="col-form-label col-lg-12"> عدد المشاهدات للدرس     </label>
                            <div class="col-lg-12">
                                <input type="number" name="default_view_number" value='{{ $course->default_view_number }}' class="form-control @error('default_view_number')  is-invalid @enderror" required
                                placeholder=''>
                                @error('default_view_number')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label col-lg-12"> رقم التواصل للاشتراك  </label>
                            <div class="col-lg-12">
                                <input type="text" name="contact_mobile" value='{{ $course->contact_mobile }}' class="form-control @error('contact_mobile')  is-invalid @enderror" required
                                placeholder=''>
                                @error('contact_mobile')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <div class="col-md-6">
                            <label class="col-form-label col-lg-12">   عدد المشاهدات التلقائى للمكتبه    </label>
                            <div class="col-lg-12">
                                <input type="number" name="default_library_views_number" value='{{ $course->default_library_views_number }}' class="form-control @error('default_library_views_number')  is-invalid @enderror" required
                                placeholder=''>
                                @error('default_library_views_number')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label col-lg-12">  عدد التنزيلات التلقائى للمكتبه   </label>
                            <div class="col-lg-12">
                                <input type="text" name="default_library_download_number" value='{{ $course->default_library_download_number }}' class="form-control @error('default_library_download_number')  is-invalid @enderror" required
                                placeholder=''>
                                @error('default_library_download_number')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="col-form-label col-lg-12"> @lang('courses.price') <span class="text-danger">*</span>    </label>
                            <div class="col-lg-12">
                                <input type="number" name="price" value='{{ $course->price }}' class="form-control @error('price')  is-invalid @enderror" required
                                placeholder=''>
                                @error('price')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="col-lg-12 col-form-label "> تفعيل الكورس </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="active"  @checked($course->is_active) >
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="col-lg-12 col-form-label "> عرض داخل الصفحه الرئيسيه </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input"  name="show_in_home" @checked($course->suggest_course) >
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label class="col-lg-12 col-form-label "> كورس مجانى </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input"  name="is_free" @checked($course->is_free) >
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="col-lg-12 col-form-label "> عرض السعر </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input"  name="show_price" @checked($course->show_price) >
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label class="col-lg-12 col-form-label ">  الاشتراك المباشر فى الكورس </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="direct_register" {{ $course->direct_register == 1 ? 'checked' : '' }} >
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label col-lg-12"> طريقه عرض عدد الطلاب <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select name="students_count_status" class='form-control form-select'  id="">
                                    <option value="1" {{ $course->students_count_status == 1 ? 'selected="selected"' : '' }} > عرض عدد الطلاب الحقيقى </option>
                                    <option value="2" {{ $course->students_count_status == 2 ? 'selected="selected"' : '' }} > عرض عدد وهمى </option>
                                    <option value="3" {{ $course->students_count_status == 3 ? 'selected="selected"' : '' }} > عدم عرض عدد الطلاب نهئى </option>
                                </select>
                                @error('students_count_status')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label col-lg-12"> عدد الطلاب الوهمى  </label>
                            <div class="col-lg-12">
                                <input type="number" name="fake_students_count" value='{{ $course->fake_students_count }}' class="form-control @error('fake_students_count')  is-invalid @enderror" placeholder=''>
                                @error('fake_students_count')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label class="col-form-label col-lg-12">  عدد الايام لاتاحه الكورس للطالب </label>
                            <div class="col-lg-12">
                                <input type="number" name="period" value='{{  $course->period }}' class="form-control @error('period')  is-invalid @enderror" placeholder=''>
                                @error('period')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                            <div class="col-sm-3 mt-4">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" name='force_face_detecting' id="sc_lss_c"  {{ $course->force_face_detecting == 1 ? 'checked' : '' }}>
                                    <label class=""> استخدام الوجه المام الكاميره </label>
                                </div>
                            </div>


                            <div class="col-sm-3 mt-4">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" name='speak_user_phone' id="sc_lss_c"  {{ $course->speak_user_phone == 1 ? 'checked' : '' }}>
                                    <label class=""> نطق رقم الطالب </label>
                                </div>
                            </div>


                            <div class="col-sm-3 mt-4">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" name='show_phone_on_viedo' id="sc_lss_c"  {{ $course->show_phone_on_viedo == 1 ? 'checked' : '' }}>
                                    <label class=""> اظهار رقم الطالب على الفديو </label>
                                </div>
                            </div>



                            <div class="col-sm-3 mt-4">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" name='force_headphones' id="sc_lss_c"  {{ $course->force_headphones == 1 ? 'checked' : '' }}>
                                    <label class=""> اجبار السمعات </label>
                                </div>
                            </div>

                            <div class="col-sm-3 mt-4">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" name='force_water_mark' id="sc_lss_c"  {{ $course->force_water_mark == 1 ? 'checked' : '' }}>
                                    <label class=""> العلامه المائيه داخل المكتبه </label>
                                </div>
                            </div>


                            <div class="col-sm-3 mt-4">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" name='allow_download' id="sc_lss_c"  {{ $course->allow_download == 1 ? 'checked' : '' }}>
                                    <label class=""> السماح بالتحميل داخل المكتبه </label>
                                </div>
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
