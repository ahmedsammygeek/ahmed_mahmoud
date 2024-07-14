<form action="{{ route('board.exams.store') }}" method="POST"  enctype="multipart/form-data" >
    <div class="card-body">
        @csrf
        <div class="mb-4">
            <div class="fw-bold border-bottom pb-2 mb-3"> @lang('exams.exam details') </div>
            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('exams.title') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <div class="input-group">
                        <input type="text" name="title_ar" class="form-control" placeholder="@lang('exams.title in arabic')">
                        <input type="text" name="title_en" class="form-control" placeholder="@lang('exams.title in english')">
                    </div>
                    <div class="input-group">
                        <div class="col-md-6">
                            @error('title_ar')
                            <p class='text-danger' > {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            @error('title_en')
                            <p class='text-danger' > {{ $message }} </p>
                            @enderror 
                        </div>  
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('exams.date') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <div class="input-group">
                        <span class="input-group-text"><i class="ph-calendar"></i></span>
                        <input type="text" name='date' class="form-control daterange-time" value="03/18/2020 - 03/23/2020"> 
                    </div>
                </div>
                @error('date')
                <p class='text-danger' > {{ $message }} </p>
                @enderror
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="col-form-label col-lg-12"> @lang('exams.duration') <span class="text-danger">*</span></label>
                    <div class="col-lg-12">
                        <input type="text" name="duration" value="{{ old('duration') }}" class="form-control @error('duration')  is-invalid @enderror"  >
                        @error('duration')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="col-form-label col-lg-12"> @lang('exams.course') <span class="text-danger">*</span></label>
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
            </div>

            <div class="row mb-3">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"> @lang('exams.questions limit to students') </label>
                        <input type="number" name='question_limit' class="form-control" required > 
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"> @lang('exams.student pass degree') </label>
                        <input type="number" name='pass_degree' class="form-control" required >
                    </div>
                </div>

               
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-check form-switch mt-4">
                            <input type="checkbox" value='1' class="form-check-input" name="can_student_see_result" >
                            <span class="form-check-label"> @lang('exams.allow students to see result') </span>
                        </label>
                    </div>
                </div>

                 <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-check form-switch mt-4">
                            <input type="checkbox" value='1' class="form-check-input" name="can_user_re_exam" wire:model.live='can_user_re_exam' >
                            <span class="form-check-label"> @lang('exams.allow students to re exam ')  </span>
                        </label>
                    </div>
                </div>

                @if ($can_user_re_exam)
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"> @lang('exams.min degree to re-exam') </label>
                        <input type="number" name='min_degree_to_re_exam' class="form-control" required > 
                    </div>
                </div>
                @endif
            </div>


            <div class="fw-bold border-bottom pb-2 mb-3"> @lang('exams.questions')  </div>

            <div class="row mb-3"  >
                <label class="col-lg-2 col-form-label pt-0"> @lang('exams.questions') </label>
                <div class="col-lg-10">
                    <select name="questions[]" wire:model.live='selected_qestions' multiple class="form-control listbox-basic">
                        @foreach ($this->questions as $question)
                        <option value="{{ $question->id }}"> {{ $question->getTranslation('content' , 'ar' ) }} </option>
                        @endforeach
                    </select>
                </div>
            </div>




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
            // $(el).find('input[name="from[]"]').timepicker({});
            // $(el).find('input[name="to[]"]').timepicker({});

            const listboxBasicElement = document.querySelector(".listbox-basic");
            const listboxBasic = new DualListbox(listboxBasicElement);
        })




    });

</script>
@endpush