<form wire:submit='save' enctype="multipart/form-data" >
    <div class="card-body">

        <div class="mb-4">
            <div class="fw-bold border-bottom pb-2 mb-3"> @lang('groups.gourp details') </div>

            <div wire:loading> 
                <div class="card-overlay card-overlay-fadeout">
                    <span class="ph-spinner spinner"></span>
                    جارى التحقق من المواعيد برجاء الانتظار
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="col-form-label col-lg-12"> @lang('groups.name') <span class="text-danger">*</span></label>
                    <div class="col-lg-12">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name')  is-invalid @enderror"  >
                        @error('name')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label col-lg-12"> @lang('groups.course') <span class="text-danger">*</span></label>
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
                <div class="col-md-4">
                    <label class="col-form-label col-lg-12"> @lang('groups.teacher') <span class="text-danger">*</span></label>
                    <div class="col-lg-12">
                        <select name="course_teacher_id" wire:model.live='course_teacher_id' class='form-control form-select '>
                            <option value=""></option>
                            @foreach ($this->courseTeachers as $courseTeacher)
                            <option value="{{ $courseTeacher->id }}"> {{ $courseTeacher->teacher?->name }} </option>
                            @endforeach
                        </select>
                        @error('course_teacher_id')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3 ">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"> @lang('groups.maxmimam student number') </label>
                        <input type="number" name='maxmimam' class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"> @lang('groups.starts at') </label>
                        <input type="date" name='starts_at' class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">  @lang('groups.ends at') </label>
                        <input type="date" name='ends_at' class="form-control">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-lg-2 col-form-label pt-0"> @lang('groups.status') </label>
                <div class="col-lg-10">
                    <label class="form-check form-switch">
                        <input type="checkbox" value='1' class="form-check-input" name="active" checked="" >
                        <span class="form-check-label"> @lang('groups.active') </span>
                    </label>
                </div>
            </div>

            <div class="fw-bold border-bottom pb-2 mb-3"> @lang('groups.times') <button wire:click.prevent="addMoreDays" class='btn btn-primary'> <i class='icon-stack-plus'></i> </button> </div>


            @for ($i = 0; $i < $group_days ; $i++)
            <div class="row mb3">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"> @lang('groups.day') </label>
                        <select wire:model.live='days' name="days[]" id="" class='form-control form-select' >
                            <option value=""></option>
                            <option value="Saturday"> السبت </option>
                            <option value="Sunday"> الاحد </option>
                            <option value="Monday"> الاثنين </option>
                            <option value="Tuesday"> الثلاثا </option>
                            <option value="Wednesday"> الاربعاء </option>
                            <option value="Thursday"> الخميس </option>
                            <option value="Friday"> الجمعه </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"> @lang('groups.starts at') </label>
                        <input type="text" wire:model.live='from' name='from[]' class="form-control timepicker">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">  @lang('groups.ends at') </label>
                        <input type="text" wire:model.live='to' name='to[]' class="form-control timepicker">
                    </div>
                </div>
            </div>
            @endfor



        </div>

    </div>

    <div class="card-footer d-flex justify-content-end">
        <a  href='{{ route('board.groups.index') }}' class="btn btn-light" id="reset"> @lang('groups.cancel') </a>
        <button type="submit" class="btn btn-primary ms-3"> @lang('groups.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>
</form>




@push('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endpush


@push('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(function() {


        Livewire.hook('morph.added', ({ el }) => {
            $(el).find('input[name="from[]"]').timepicker({});
            $(el).find('input[name="to[]"]').timepicker({});
        })


        $('input.timepicker').timepicker({});

    });

</script>
@endpush