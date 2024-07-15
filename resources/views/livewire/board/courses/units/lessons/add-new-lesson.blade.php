<form  method="POST" wire:submit="save" enctype="multipart/form-data" >
    <div class="card-body">
        @csrf

        <div class="mb-4">
            <div class="fw-bold border-bottom pb-2 mb-3"> بيانات  الدرس </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> الفديو <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select wire:model.live='video_type' name="video_type" class="form-control form-select" id="">
                        <option value="link"> @lang('courses.link') </option>
                    </select>
                </div>

            </div>




            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> رابط الفديو <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name="video_link" value="{{ old('video_link') }}" class="form-control @error('video_link')  is-invalid @enderror" required >
                    @error('video_link')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>





            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> عنوان الدرس بالعربيه <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control @error('title_ar')  is-invalid @enderror" required >
                    @error('title_ar')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> عنوان الدرس بالانجليزيه <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name="title_en" value="{{ old('title_en') }}" class="form-control @error('title_en')  is-invalid @enderror" required >
                    @error('title_en')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> شرح الدرس بالعربيه <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <textarea name="description_ar" class='form-control ' cols="30" rows="10"> {{ old('description_ar') }} </textarea>
                    @error('description_ar')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> شرح الدرس بالانجليزيه <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <textarea name="description_en" class='form-control ' cols="30" rows="10"> {{ old('description_en') }} </textarea>
                    @error('description_en')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-2">  عدد مرات المشاهده المسموح بها <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name="allowed_views" value="{{ old('allowed_views') }}" class="form-control @error('allowed_views')  is-invalid @enderror" required >
                    @error('allowed_views')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-lg-2 col-form-label pt-0"> درس مجانى </label>
                <div class="col-lg-10">
                    <label class="form-check form-switch">
                        <input type="checkbox" value='1' class="form-check-input" name="is_free"  >
                        <span class="form-check-label"> نعم </span>
                    </label>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-lg-2 col-form-label pt-0"> السماح بالعرض </label>
                <div class="col-lg-10">
                    <label class="form-check form-switch">
                        <input type="checkbox" value='1' class="form-check-input" name="is_active" checked="" >
                        <span class="form-check-label"> نعم </span>
                    </label>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> ملفات الدرس </label>
                <div class="col-lg-10">
                    <input type="file" multiple name="files[]"  class="form-control @error('files')  is-invalid @enderror"  >
                    @error('files.*')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                    <p class="text-info"> الملفات المسموح بها هيا doc docx  ,pdf , zip , rar , png , jpg , jpeg ,  </p>
                </div>
            </div>

        </div>



    </div>

    <div class="card-footer d-flex  justify-content-end">
        <a  href='{{ route('board.courses.units.lessons.index' , [ 'course' => $course  , 'unit' => $unit ] ) }}' class="btn btn-light" id="reset"> الغاء </a>
        <button type="submit" class="btn btn-primary ms-3"> إضافه <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>
</form>

@push('styles')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

@endpush

@push('scripts')
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
                    } , 
                    chunkUploads : true , 
                    chunkSize : 5000 , 
                }
            });
            FilePond.create(document.querySelector('input[name="video"]'));       


    });
</script>
@endpush