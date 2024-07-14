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
                <label class="col-form-label col-lg-2"> @lang('questions.degree') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name="degree" wire:model.live='degree'  class="form-control @error('degree')  is-invalid @enderror"  placeholder="">
                    @error('degree')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
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
                <label class="col-form-label col-lg-2"> @lang('questions.choices') </label>
                <div class="col-lg-10">
                    <div class="row">

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <input type="radio" class="form-check-input mt-0" value="0" name="correct_answer" wire:model.live='correct_answer' checked>
                                    </span>
                                    <input type="text" name='answers_ar[]' wire:model.live='answers_ar.0' class="form-control" placeholder="@lang('questions.answer in arabic')">
                                    <input type="text" name='answers_en[]' wire:model.live='answers_en.0' class="form-control" placeholder="@lang('questions.answer in english')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error("answers_ar")
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                @error("answers_en")
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <input type="radio" class="form-check-input mt-0" value="1" name="correct_answer" wire:model.live='correct_answer' >
                                    </span>
                                    <input type="text" name='answers_ar[]' wire:model.live='answers_ar.1' class="form-control" placeholder="@lang('questions.answer in arabic')">
                                    <input type="text" name='answers_en[]' wire:model.live='answers_en.1' class="form-control" placeholder="@lang('questions.answer in english')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error("answers_ar")
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                @error("answers_en")
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <input type="radio" class="form-check-input mt-0" value="2" name="correct_answer" wire:model.live='correct_answer' >
                                    </span>
                                    <input type="text" name='answers_ar[]' wire:model.live='answers_ar.2' class="form-control" placeholder="@lang('questions.answer in arabic')">
                                    <input type="text" name='answers_en[]' wire:model.live='answers_en.2' class="form-control" placeholder="@lang('questions.answer in english')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error("answers_ar")
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                @error("answers_en")
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <input type="radio" class="form-check-input mt-0" value="3" name="correct_answer" wire:model.live='correct_answer' >
                                    </span>
                                    <input type="text" name='answers_ar[]' wire:model.live='answers_ar.3' class="form-control" placeholder="@lang('questions.answer in arabic')">
                                    <input type="text" name='answers_en[]' wire:model.live='answers_en.3' class="form-control" placeholder="@lang('questions.answer in english')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error("answers_ar")
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                @error("answers_en")
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        
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



