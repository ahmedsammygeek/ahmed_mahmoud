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


                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.course') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='course_id' class="form-select form-control @error('course_id') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"> {{ $course->title }} -- {{ $course->id }} </option>
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
                        <span class="badge d-block bg-primary text-start mt-1"> المبلغ المتبقى : {{ $purchase_price - $paid }} </span>
                        <table class='table table-bordered table-condensed mt-2'>
                            <thead>
                                <tr>
                                    <th>المبلغ <button wire:click='addMoreInstallments()' class='btn btn-sm btn-primary'> <i class="icon-plus3"></i> </button> </th>
                                    <th>تاريخ الاستحقاق</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $installment_months_count ; $i++)
                                    <tr class='installments'>
                                    <td>
                                        <input type="number"wire:model.live='installment_amounts.{{ $i }}'  class="form-control">
                                        @error("installment_amounts.{{ $i }}")
                                        <p class="text-danger"> {{ $message }} </p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="date" wire:model.live='installment_months.{{ $i }}' class="form-control">
                                        @error("installment_months.{{ $i }}")
                                        <p class="text-danger"> {{ $message }} </p>
                                        @enderror
                                    </td>
                                    <td> <button class='btn btn-danger btn-sm delete_row'> <i class='icon-trash'> </i>  </button> </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
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
                            <label class="col-form-label col-sm-3"> حضور المقر  </label>
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
                        <button wire:click='save' class="btn btn-primary"> @lang('dashboard.add') </button>
                    </div>
             
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


    // $(document).on('click', 'button.add_more_installments', function(event) {
    //     event.preventDefault();
    //     $(document).find('tr.installments').last().after(`<tr class='installments'>
    //                                 <td><input type="number" class="form-control"></td>
    //                                 <td><input type="date" class="form-control"></td>
    //         <td> <button class='btn btn-danger btn-sm delete_row'> <i class='icon-trash'> </i>  </button> </td>
    //         </tr>`);
    // });


    $(document).on('click', 'button.delete_row', function(event) {
        event.preventDefault();
        $(this).parent().parent().remove();
    });

</script>
@endpush