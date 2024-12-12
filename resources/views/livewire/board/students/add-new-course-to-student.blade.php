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
                            <label class="col-form-label col-sm-3"> الاجزاء </label>
                            <div class="col-sm-9">
                                <select wire:model.live='student_units' multiple="multiple" class="form-select form-control @error('student_units') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($this->units as $unit)
                                    <option value="{{ $unit->id }}"> {{ $unit->title }} </option>
                                    @endforeach
                                </select>
                                @error('student_units')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.group') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='group_id' class="form-select form-control @error('group_id') is-invalid @enderror " id="">
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
                                <input type="text" class='form-control' wire:model.live='purchase_price' >
                                @error('purchase_price')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.paid') </label>
                            <div class="col-sm-9">
                                <input type="text" class='form-control' wire:model.live='paid' >
                                @error('paid')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>
                        </div>

                        @if ($paid < $purchase_price )
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.installment_months') </label>
                            <div class="col-sm-9">
                                <input type="text" class='form-control' wire:model.live='installment_months' >
                                @error('installment_months')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                                <span class="badge d-block bg-primary text-start mt-1">    قيمه القسط الواحد : {{ $this->single_installment }} </span>
                            </div>

                        </div>
                        @endif

                        



                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.allow to view on app') </label>
                            <div class="col-sm-9">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" id="sc_lss_c" wire:model.live='allow' checked>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> حضور المقر فقط </label>
                            <div class="col-sm-9">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" id="sc_lss_c" wire:model.live='in_office' checked>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> الاشتراك فى الورق من المقر </label>
                            <div class="col-sm-9">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" id="sc_lss_c" wire:model.live='office_library' checked>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> المكتبه الاكترونيه </label>
                            <div class="col-sm-9">
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" class="form-check-input" id="sc_lss_c" wire:model.live='online_library' checked>
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