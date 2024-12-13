<form wire:submit="save"  enctype="multipart/form-data" >
    <div class="card-body">
        @csrf
        <div class="mb-4">
            <div class="fw-bold border-bottom pb-2 mb-3"> @lang('announcements.exam details') </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('announcements.type') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select name="course_id" wire:model.live='type' class='form-control form-select select  @error('type')  is-invalid @enderror'>
                        <option value=""></option>
                        <option value="1"> @lang('announcements.image') </option>
                        <option value="2"> @lang('announcements.text') </option>                        
                    </select>
                    @error('type')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>

            </div>
            
            @if ($type)

            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('announcements.title_ar') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name='title_ar' wire:model.live='title_ar' class="form-control " > 
                    @error('title_ar')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('announcements.title_en') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name='title_en' wire:model.live='title_en' class="form-control " > 
                    @error('title_en')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>



            @switch($type)
            @case(1)
            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('announcements.image') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="file" name='image' wire:model.live='image' class="form-control " > 
                    @error('image')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
                
            </div>
            @break
            @case(2)
            
            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('announcements.content_ar') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name='content_ar' wire:model.live='content_ar' class="form-control " > 
                    @error('content_ar')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('announcements.content_en') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name='content_en' wire:model.live='content_en' class="form-control " > 
                    @error('content_en')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
                
            </div>

            @break
            @endswitch
            



            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('announcements.publish_for') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select name="publish_for" wire:model.live='publish_for' class='form-control form-select select  @error('publish_for')  is-invalid @enderror'>
                        <option value=""></option>
                        <option value="1"> @lang('announcements.all students') </option>
                        <option value="2"> @lang('announcements.some students') </option>                        
                    </select>
                    @error('publish_for')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>


            @endif







            <div class="fw-bold border-bottom pb-2 mb-3"> @lang('announcements.students')  </div>

            @if ($publish_for == 2)

            <div class="row mb-3"  >


                <div class="fw-bold border-bottom pb-2 mb-3"> @lang('students.students')  </div>
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label class="col-form-label col-lg-12"> @lang('announcements.course') <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-12">
                                    <select name="course_id" wire:model.live='course_id' class='form-control form-select select'>
                                        <option value=""></option>
                                        @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"> {{ $course->title }} </option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <p class='text-danger' > {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="search"  wire:model.live='search'  class="form-control"placeholder='البحث داخل الصلاب'  >
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <table class='table table-xs table-responsive table-bordered' >
                                <thead class='text-center bg-dark  text-white'>
                                    <tr>
                                        <th  > @lang('announcements.question') </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($this->students as $student)
                                    <tr>
                                        <td> 
                                            <div class="form-check">
                                                <input name="students[]" wire:model.live='selected_students' value="{{ $student->id }}" type="checkbox" class="form-check-input" id="cc_ls_c{{ $student->id }}"  >
                                                <label class="ms-2" for="dc_ls_c{{ $student->id }}">
                                                    {{ $student->name }} -- {{ $student->mobile }}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pagination hstack gap-3">
                            {{ $this->students->links() }}
                        </div>
                    </div>
                </div>

            </div>


            @endif

        </div>

    </div>

    <div class="card-footer d-flex justify-content-end">
        <a  href='{{ route('board.announcements.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
        <button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>
</form>




@push('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endpush


@push('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/media/glightbox.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/gallery_library.js') }}"></script>


<script>
    $(function() {



        Livewire.on('added', () =>  {
            swalInit.fire({
                text: "@lang('dashboard.added successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });

    });

</script>
@endpush