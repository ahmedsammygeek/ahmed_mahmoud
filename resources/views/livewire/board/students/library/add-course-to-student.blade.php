<div class="card-body border border-primary mt-1">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger delete_entire_row " style='float:left'> <i class='icon-trash '> </i>  </button>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-6"  wire:ignore.self>
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

    <div class="col-sm-6" wire:ignore.self >
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
{{-- 

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



        --}}
        <div class="col-sm-4">
            <label class="col-form-label col-sm-3"> الاجزاء </label>
            <select wire:model.live='units_id' required multiple="multiple" name='student_units[{{ $course_id }}][]' class="form-select form-control @error('units_id') is-invalid @enderror " id="">
                <option value=""></option>
                @foreach ($this->units as $unit)
                <option value="{{ $unit->id }}"> {{ $unit->title }} </option>
                @endforeach
            </select>
            @error('units_id')
            <p class='is-invalid text-danger'> {{ $message }} </p>
            @enderror 
            {{ var_dump($units_id) }}
        </div>

        <div class="col-sm-4">
            <label class="col-form-label col-sm-3"> الدروس </label>
            <select wire:model.live='lessons_id' required multiple="multiple" name='lessons_id[{{ $course_id }}][]' class="form-select form-control @error('lessons_id') is-invalid @enderror " id="">
                <option value=""></option>
                @foreach ($this->lessons as $lesson)
                <option value="{{ $lesson->id }}"> {{ $lesson->title }} </option>
                @endforeach
            </select>
            @error('lessons_id')
            <p class='is-invalid text-danger'> {{ $message }} </p>
            @enderror 
            {{ var_dump($lessons_id) }}

        </div>


        <div class="col-sm-4">
            <label class="col-form-label col-sm-3"> الدروس </label>
            <select wire:model.live='files_id' required multiple="multiple" name='files_id[{{ $course_id }}][]' class="form-select form-control @error('files_id') is-invalid @enderror " id="">
                <option value=""></option>
                @foreach ($this->files as $file)
                <option value="{{ $file->id }}"> {{ $file->name }} -- {{ $file->id }} </option>
                @endforeach
            </select>
            @error('files_id')
            <p class='is-invalid text-danger'> {{ $message }} </p>
            @enderror 
            {{ var_dump($lessons_id) }}
            <div class="form-check form-check-reverse mb-2">
                <input type="checkbox" wire:click='selectAllLessons' class='form-check-input form-control' > 
                <label for=""> تحديد كافه الملفات </label>
            </div>

            
            
        </div>
    </div>








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