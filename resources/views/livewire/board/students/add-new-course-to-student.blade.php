<div>
    <button  data-bs-toggle="modal" data-bs-target="#add_new_course_to_student_modal" class='btn btn-primary mb-2' style="float: left;">  <i class="icon-plus3 me-2"></i>  
        @lang('students.add new course to student')
    </button>

    <div id="add_new_course_to_student_modal" class="modal fade" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('students.add new course to student')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit="save" class="form-horizontal">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.course') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='course_id' class="form-select form-control @error('course_id') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"> {{ $course->title }} </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.teacher') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='teacher_id' class="form-select form-control  @error('teacher_id') is-invalid @enderror" id="">
                                    <option value=""></option>
                                    @foreach ($this->teachers as $teacher)
                                    <option value="{{ $teacher->id }}"> {{ $teacher->name }} </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.group') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='group_id' class="form-select form-control  @error('group_id') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($this->groups as $group)
                                    <option value="{{ $group->id }}"> {{ $group->name }} </option>
                                    @endforeach
                                </select>
                                @error('group_id')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.purchase_price') </label>
                            <div class="col-sm-9">
                                <input type="text" wire:model.live='purchase_price' class='form-control  @error('purchase_price') is-invalid @enderror' >
                                @error('purchase_price')
                                <p class='invalid-feedback text-danger'> {{ $message }} </p>
                                @enderror  
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.deposit') </label>
                            <div class="col-sm-9">
                                <input type="text" wire:model.live='deposit' class='form-control  @error('deposit') is-invalid @enderror' >
                                @error('deposit')
                                <p class='invalid-feedback text-danger'> {{ $message }} </p>
                                @enderror   

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.allow') </label>
                            <div class="col-sm-9">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" id="sc_lss_c" wire:model.live='allow' checked>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal"> @lang('dashboard.cancel') </button>
                        <button type="submit" class="btn btn-primary"> @lang('dashboard.add') </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script>
    const swalInit = swal.mixin({
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-light',
            denyButton: 'btn btn-light',
            input: 'form-control'
        }
    });
    Livewire.on('studentAddedToCourse' , () => {
        $(document).find('#add_new_course_to_student_modal').modal('hide');
        swalInit.fire({
            text: "@lang('dashboard.addedd successfully')" ,
            icon: 'success',
            toast: true,
            showConfirmButton: false,
            position: 'top-start' , 
            timer: 1500
        });


    });
</script>
@endpush