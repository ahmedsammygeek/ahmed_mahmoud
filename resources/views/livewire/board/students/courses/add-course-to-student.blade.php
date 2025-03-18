<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"> @lang('courses.add new course') </h5>
                </div>
                <div class="card-body">
                    <form class="" method="POST" action="{{ route('board.courses.store') }}" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-4" wire:ignore>
                                    <label class="col-form-label"> @lang('students.teacher') </label>
                                    <select wire:model.live='teacher_id' data-placeholder="اختر المدرس..." class="teachers form-control @error('teacher_id') is-invalid @enderror " id="">
                                        <option value=""></option>
                                        @foreach ($this->teachers as $teacher)
                                        <option value="{{ $teacher->id }}"> {{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                    <p class='is-invalid text-danger'> {{ $message }} </p>
                                    @enderror 
                                </div>

                                <div class="col-sm-4" >
                                    <label class="col-form-label"> @lang('students.course') </label>
                                    <select  wire:model.live='course_id'  data-placeholder="اختر الماده..." class=" courses form-select form-control @error('course_id') is-invalid @enderror " id="">
                                        <option value=""></option>
                                        @foreach ($this->courses as $course)
                                        <option value="{{ $course->id }}"> {{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <p class='is-invalid text-danger'> {{ $message }} </p>
                                    @enderror 
                                </div>
                            </div>
                       {{--  <div class="row mb-3">
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
                        </div> --}}
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
                       {{--  @if ($paid < $purchase_price )
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
                        @endif --}}
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

                    <div class="card-footer d-flex justify-content-end">
                        <a href='{{ route('board.courses.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
                        <button type="submit" class="btn btn-primary ms-3">
                            @lang('dashboard.add') 
                            <i  class="ph-paper-plane-tilt ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


@push('scripts')
<script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script>
{{-- <script src="{{ asset('board_assets/demo/pages/form_select2.js') }}"></script> --}}
<script>

    $(function() {
        $('.teachers').select2();
        $('.teachers').on('change', function (e) {
            var data = $('.teachers').select2("val");
            @this.set('teacher_id', data);
            console.log(data);
            $('.courses').select2();
        });


        $('.courses').on('change', function (e) {
            var data = $('.courses').select2("val");
            @this.set('course_id', data);
        });
    });
    
</script>
@endpush