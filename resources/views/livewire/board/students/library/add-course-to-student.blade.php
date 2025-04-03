<div class="card-body border border-primary mt-1">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger delete_entire_row " style='float:left'> <i class='icon-trash '> </i>  </button>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-4"  wire:ignore.self>
            <label class="col-form-label"> @lang('students.teacher') </label>
            <select wire:model.live='teacher_id' required  data-placeholder="اختر المدرس..." class="teachers form-control 
            @error('teacher_id') is-invalid @enderror " id="">
                <option value=""></option>
                @foreach ($this->teachers as $teacher)
                <option value="{{ $teacher->id }}"> {{ $teacher->name }}</option>
                @endforeach
            </select>
            @error('teacher_id')
            <p class='is-invalid text-danger'> {{ $message }} </p>
            @enderror 
        </div>

        <div class="col-sm-4" wire:ignore.self >
            <label class="col-form-label"> @lang('students.course') </label>
            <select  wire:model.live='course_id' name='courses[]' required data-placeholder="اختر الماده..." class="courses form-select form-control @error('course_id') is-invalid @enderror " id="">
                <option value=""></option>
                @foreach ($this->courses as $course)
                <option value="{{ $course->id }}"> {{ $course->title }}</option>
                @endforeach
            </select>
            @error('course_id')
            <p class='is-invalid text-danger'> {{ $message }} </p>
            @enderror 
        </div>


        <div class="col-sm-4" wire:ignore.self>
            <label class="col-form-label "> @lang('students.group') </label>
            <select wire:model.live='group_id' required name='groups[{{ $course_id }}]' class="form-select form-control @error('group_id') is-invalid @enderror " id="">
                <option value=""></option>
                @foreach ($this->groups as $group)
                <option value="{{ $group->id }}"> {{ $group->name }} </option>
                @endforeach
            </select>
            @error('group_id')
            <p class='is-invalid text-danger'> {{ $message }} </p>
            @enderror 
        </div>




        <div class="col-sm-4">
            <label class="col-form-label col-sm-3"> الاجزاء </label>
            <select wire:model.live='student_units' required multiple="multiple" name='student_units[{{ $course_id }}][]' class="form-select form-control @error('student_units') is-invalid @enderror " id="">
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


    @if ($paid < $purchase_price )
    <div class="table-responsive">
        <span class="badge d-block bg-primary text-start mt-1"> المبلغ المتبقى : {{ $purchase_price - $paid }} </span>
        <table class='table table-bordered table-condensed mt-2'>
            <thead>
                <tr>
                    <th>المبلغ <button wire:click.prevent='addMoreInstallments' class='btn btn-sm btn-primary'> <i class="icon-plus3"></i> </button> </th>
                    <th>تاريخ الاستحقاق</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < $installment_months_count ; $i++)
                <tr class='installments'>
                    <td>
                        <input type="number"wire:model.live='installment_amounts.{{ $i }}' name='installment_amounts[{{ $course_id }}][]'  class="form-control">
                        @error("installment_amounts.{{ $i }}")
                        <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </td>
                    <td>
                        <input type="date" wire:model.live='installment_months.{{ $i }}' name='installment_months[{{ $course_id }}][]' class="form-control">
                        @error("installment_months.{{ $i }}")
                        <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </td>
                    <td> <button class='btn btn-danger btn-sm delete_row'> <i class='icon-trash'> </i>  </button> </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
    @endif








</div>

@push('scripts')
<script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script>
{{-- <script src="{{ asset('board_assets/demo/pages/form_select2.js') }}"></script> --}}
<script>

    $(document).ready(function() {


        

        $(document).on('click', 'button.delete_entire_row', function(event) {
            event.preventDefault();
            Livewire.dispatch('deleteEntireComponant');
        });


        $(document).on('click', 'button.delete_row', function(event) {
            event.preventDefault();
            $(this).parent().parent().remove();
        });

    });

    // function loadJquery() {
    //     $('.teachers').select2();
    //     $('.courses').select2();
    //     $('.teachers').on('change', function (e) {
    //         var data = $('.teachers').select2("val");
    //         @this.set('teacher_id', data);
    //     });

    //     $('.courses').on('change', function (e) {
    //         var data = $('.courses').select2("val");
    //         @this.set('course_id', data);
    //     });
    // }




    // window.Livewire.on('select2',()=>{
    //     loadJquery();
    //     alert('gfgf');
    // });



    // document.addEventListener('livewire:initialized', function () {
    //     // Initialize Select2 on the select inputs
    //     loadJquery();
    //  // Reinitialize Select2 when Livewire updates the DOM
    //     // Livewire.hook('message.processed', () => {
    //     //     alert('ggg');
    //     //     loadJquery();
    //     // });
    // });

</script>
@endpush