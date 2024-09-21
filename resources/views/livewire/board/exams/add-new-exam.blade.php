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
                        <input type="text" name='date' wire:model.live='date' class="form-control daterange-time" > 
                    </div>
                </div>
                @error('date')
                <p class='text-danger' > {{ $message }} </p>
                @enderror
            </div>


            <div class="row mb-3">
               {{--  <div class="col-md-3">
                    <label class="col-form-label col-lg-12"> @lang('exams.type') <span class="text-danger">*</span></label>
                    <div class="col-lg-12">
                        <select name="course_id" wire:model.live='type' class='form-control form-select select  @error('type')  is-invalid @enderror'>
                            <option value="1"> @lang('exams.general exam') </option>
                            <option value="2"> @lang('exams.lesson exam') </option>                        
                        </select>
                    </div>
                </div>
                --}}



                <div class="col-md-3">
                    <label class="col-form-label col-lg-12"> @lang('exams.duration') <span class="text-danger">*</span></label>
                    <div class="col-lg-12">
                        <input type="number" name="duration" value="{{ old('duration') }}" class="form-control @error('duration')  is-invalid @enderror"  >
                        @error('duration')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>
            </div>

{{--             <div class="row mb-3 ">
                <div class="col-md-3">
                    <label class="col-form-label col-lg-12"> @lang('exams.questions choosing type') <span class="text-danger">*</span></label>
                    <div class="col-lg-12">
                        <select name="questions_choosing_type" wire:model.live='questions_choosing_type' class='form-control form-select select'>
                            <option value="1"> @lang('exams.choose by me') </option>
                            <option value="2"> @lang('exams.random') </option>
                        </select>
                        @error('questions_choosing_type')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>
            </div>
            --}}
            <div class="row mb-3">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"> @lang('exams.questions limit to students') </label>
                        <input type="number" name='question_limit' class="form-control" required > 
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"> نسبه النجاح فى الامتحان </label>
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

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label"> @lang('exams.retry  count') </label>
                        <input type="number" name='retry_count' class="form-control" required > 
                    </div>
                </div>

                <div class="col-lg-3">
                    <label class="col-form-label col-lg-12"> الامتحان بنفس الاسئله <span class="text-danger">*</span></label>
                    <div class="col-lg-12">
                        <select name="retry_same_exam_questions" wire:model.live='retry_same_exam_questions' class='form-control form-select select'>
                            <option value="1"> @lang('exams.yes') </option>
                            <option value="2"> @lang('exams.no') </option>
                        </select>
                        @error('retry_same_exam_questions')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>

                @endif
            </div>


            <div class="fw-bold border-bottom pb-2 mb-3"> @lang('exams.questions')  </div>


            <div class="row mb-3"  >
                <div class="card">
                    <div class="card-header">
                        <div class="row">
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
                            <div class="col-md-6">
                                <label class="col-form-label col-lg-12"> @lang('exams.lesson') <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select name="lesson_id" wire:model.live='lesson_id' class='form-control form-select select'>
                                        <option value=""></option>
                                        @foreach ($this->lessons as $lesson)
                                        <option value="{{ $lesson->id }}"> {{ $lesson->title }} </option>
                                        @endforeach
                                    </select>
                                    @error('lesson_id')
                                    <p class='text-danger' > {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <input type="search" name="search" wire:model.live='search'  class="form-control"placeholder='البحث داخل الاسئله'  >
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <table class='table table-xs table-responsive table-bordered' >
                                <thead class='text-center bg-dark  text-white'>
                                    <tr>
                                        <th  > @lang('exams.questions') </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                    <tr>
                                        <td> 
                                            <div class="form-check">
                                                <input name="questions[]" wire:model.live='selected_qestions' value="{{ $question->id }}" type="checkbox" class="form-check-input" id="cc_ls_c{{ $question->id }}"  >
                                                <label class="ms-2" for="dc_ls_c{{ $question->id }}">
                                                    <ul class='list-inline ' >
                                                        <li>  {{ $question->content }}  </li>
                                                        @foreach ($question->answers as $answer)
                                                        <li class='list-inline-item {{ $answer->is_correct_answer ? 'text-success' : 'text-danger' }} '> 
                                                            {{ $answer->content }} 
                                                        </li>
                                                        @endforeach
                                                    </ul>
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
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>

                <div class="fw-bold border-bottom pb-2 mb-3"> @lang('students.students')  </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <input type="search"  wire:model.live='search_students'  class="form-control"placeholder='البحث داخل الصلاب'  >
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <table class='table table-xs table-responsive table-bordered' >
                                <thead class='text-center bg-dark  text-white'>
                                    <tr>
                                        <th  > @lang('exams.question') </th>
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



        </div>

    </div>

    <div class="card-footer d-flex justify-content-end">
        <a  href='{{ route('board.exams.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
        <button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>
</form>




@push('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endpush


@push('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(function() {

        // Livewire.hook('morph.added', ({ el }) => {
        //     // $(el).find('input[name="from[]"]').timepicker({});
        //     // $(el).find('input[name="to[]"]').timepicker({});

        //     const listboxBasicElement = document.querySelector(".listbox-basic");
        //     const listboxBasic = new DualListbox(listboxBasicElement);
        // })




    });

</script>
@endpush