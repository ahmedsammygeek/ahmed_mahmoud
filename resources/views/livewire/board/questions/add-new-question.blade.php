<div>
    <form   enctype="multipart/form-data" >
        <div class="card-body">

            @csrf

            <div class="mb-4">
                <div class="fw-bold border-bottom pb-2 mb-3"> @lang('questions.question details') </div>

                <div class="row mb-3">
                    <label class="col-form-label col-lg-2"> @lang('questions.course') <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <select name="course_id" wire:model.live='course_id'  class="form-control form-select" id="">
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

                <div class="row mb-3">
                    <label class="col-form-label col-lg-2"> @lang('questions.lesson') <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <select name="lesson_id" wire:model.live='lesson_id'  class="form-control form-select" id="">
                            <option value=""></option>
                            @foreach ($this->lessons as $lesson)
                            <option value="{{ $lesson->id }}"> {{ $lesson->content }} </option>
                            @endforeach
                        </select>
                        @error('lesson_id')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-form-label col-lg-2"> @lang('questions.degree') <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" name="degree" wire:model.live='degree'  class="form-control @error('degree')  is-invalid @enderror"  placeholder="">
                        @error('degree')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <label class="col-form-label col-lg-2"> @lang('questions.calculators') <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <div class="form-check form-switch  mb-2 center-block ">
                            <input type="checkbox" wire:model.live='calculators' class="form-check-input" >
                        </div>
                    </div>
                </div>






                <div class="row mb-3">
                    <label class="col-form-label col-lg-2"> @lang('questions.question type') <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <select name="question_type" wire:model.live='question_type' class="form-control form-select" id="">
                            <option value=""></option>
                            <option value="1"> @lang('questions.text') </option>
                            <option value="2"> @lang('questions.image') </option>
                        </select>
                        @error('question_type')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>


                @switch($question_type)
                @case(1)
                <div class="row mb-3">
                    <label class="col-form-label col-lg-2"> @lang('questions.question') <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <input type="text" name="question_text_content_ar" wire:model.live='question_text_content_ar' class="form-control" placeholder="Input placeholder">
                            <input type="text" name="question_text_content_en" wire:model.live='question_text_content_en' class="form-control" placeholder="Input placeholder">
                        </div>

                        <div class="input-group">
                            <div class="col-md-6">
                                @error('question_text_content_ar')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                @error('question_text_content_en')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror 
                            </div>  
                        </div>
                    </div>
                </div>
                @break
                @case(2)
                <div class="row mb-3">
                    <label class="col-form-label col-lg-2"> @lang('questions.question') <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="file" name="question_image_content" wire:model.live='question_image_content'  class="form-control @error('content')  is-invalid @enderror"  placeholder="">
                        @error('question_image_content')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>
                @break
                @endswitch


                <div class="row mb-3">
                    <label class="col-form-label col-lg-2"> @lang('questions.answer type') <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <select name="answer_type" wire:model.live='answer_type' class="form-control form-select" id="">
                            <option value=""></option>
                            <option value="1"> @lang('questions.choices') </option>
                            <option value="2"> @lang('questions.content') </option>
                        </select>
                        @error('answer_type')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                    </div>
                </div>

                @if ($answer_type == 1 )
                <div class="row mb-3">
                    <label class="col-form-label col-lg-2"> @lang('questions.choices') <button class='btn btn-sm btn-primary add_more_choices'> <i class='icon-plus3 me-2' ></i> </button> </label>
                    <div class="col-lg-10">
                        <div class="row">

                            @for ($i = 0; $i < $choices_count ; $i++)
                            @if ($i == 0 )
                            <div class="row mb-3">
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <input type="radio" class="form-check-input mt-0" value="{{ $i }}" name="correct_answer" wire:model.live='correct_answer' checked>
                                        </span>
                                        <input type="text" name='answers_ar[]' wire:model.live='answers_ar.{{ $i }}' class="form-control" placeholder="@lang('questions.answer in arabic')">
                                        <input type="text" name='answers_en[]' wire:model.live='answers_en.{{ $i }}' class="form-control" placeholder="@lang('questions.answer in english')">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                       <input type="file" class="form-control mt-0" value="{{ $i }}" name="image_answers[]" wire:model.live='image_answers' checked>
                                   </div>
                               </div>
                               {{--  <div class="col-md-6">
                                    @error("answers_ar")
                                    <p class='text-danger' > {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    @error("answers_en")
                                    <p class='text-danger' > {{ $message }} </p>
                                    @enderror
                                </div> --}}
                            </div>
                            @else 
                            <div class="row mb-3">
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <input type="radio" class="form-check-input mt-0" value="{{ $i }}" name="correct_answer" wire:model.live='correct_answer' checked>
                                            </span>
                                            <input type="text" name='answers_ar[]' wire:model.live='answers_ar.{{ $i }}' class="form-control" placeholder="@lang('questions.answer in arabic')">
                                            <input type="text" name='answers_en[]' wire:model.live='answers_en.{{ $i }}' class="form-control" placeholder="@lang('questions.answer in english')">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                           <input type="file" class="form-control mt-0" value="{{ $i }}" name="image_answers[]" wire:model.live='image_answers' checked>
                                       </div>
                                   </div>
                                    </div>
                               </div>
                               <div class="col-md-1">
                                <button class='btn btn-danger delete_row' > 
                                    <i class='icon-trash '> </i>
                                </button>
                            </div>
                        </div>
                        @endif
                        @endfor

                    </div>
                </div>
            </div>
            @endif

        </div>

    </div>

    <div class="card-footer d-flex justify-content-end">
        <a  href='{{ route('board.questions.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
        <button wire:click.prevent='save()'  class="btn btn-primary ms-3"> @lang('dashboard.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>
</form>

<div id="add_more_choices_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Horizontal form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="#" class="form-horizontal">
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">First name</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Eugene" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Last name</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Kopyov" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Email</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="eugene@kopyov.com" class="form-control">
                            <div class="form-text text-muted">name@domain.com</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Phone #</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="+99-99-9999-9999" data-mask="+99-99-9999-9999" class="form-control">
                            <div class="form-text text-muted">+99-99-9999-9999</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Address line 1</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Ring street 12, building D, flat #67" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">City</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Munich" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">State/Province</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Bayern" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-form-label col-sm-3">ZIP code</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="1031" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


@section('scripts')

<script>
    $(function() {

        $(document).on('click', 'button.add_more_choices', function(event) {
            event.preventDefault();
            $(document).find('div#.add_more_choices_modal').modal('show');
        });

        $(document).on('click', 'button.delete_row', function(event) {
            event.preventDefault();
            $(this).parent().parent().remove();
            Livewire.dispatch('decreas-choices-count' , {} );
        });
    });
</script>

@endsection

