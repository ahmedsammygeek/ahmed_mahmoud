<div>
    <form class="" method="POST" action="{{ route('board.library.store') }}" enctype="multipart/form-data" >
        <div class="card-body">
            @csrf
            <div class="mb-4">
                <div class="fw-bold border-bottom pb-2 mb-3"> @lang('library.slide details') </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class=" mb-3">
                            <label class="col-form-label col-lg-12"> @lang('library.course') <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select wire:model.live="course_id" name="course_id" class="form-control form-select">
                                    <option value=""></option>
                                    @foreach ($this->courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }} </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class=" mb-3">
                            <label class="col-form-label col-lg-12"> @lang('library.unit') <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select wire:model.live="unit_id" name="unit_id" class="form-control form-select">
                                    <option value=""></option>
                                    @foreach ($this->units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->title }} </option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class=" mb-3">
                            <label class="col-form-label col-lg-12"> @lang('library.lesson') <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select wire:model.live="lesson_id" name="lesson_id" class="form-control form-select">
                                    <option value=""></option>
                                    @foreach ($this->lessons as $lesson)
                                    <option value="{{ $lesson->id }}">{{ $lesson->title }} </option>
                                    @endforeach
                                </select>
                                @error('lesson_id')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class=" mb-3">
                            <label class="col-form-label col-lg-12"> @lang('library.video') </label>
                            <div class="col-lg-12">
                                <select wire:model.live="video_id" name="video_id" class="form-control form-select">
                                    <option></option>
                                    @foreach ($this->videos as $video)
                                    <option value="{{ $video->id }}">{{ $video->title }} </option>
                                    @endforeach
                                </select>
                                @error('video_id')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class=" mb-3">
                            <label class="col-form-label col-lg-12"> @lang('library.files') </label>
                            <div class="col-lg-12">
                                <input type="file" class='form-control' name='files[]' multiple >
                                @error('video_id')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class=" mb-3">
                            <label class="col-form-label col-lg-12"> @lang('library.download_allowed_number') </label>
                            <div class="col-lg-12">
                                <input type="number" value="0" class='form-control' name='download_allowed_number'  >
                                @error('video_id')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class=" mb-3">
                            <label class="col-form-label col-lg-12"> @lang('library.allowed_views_number') </label>
                            <div class="col-lg-12">
                                <input type="number" value="10" class='form-control' name='allowed_views_number'  >
                                @error('video_id')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class=" mb-3">
                            <label class="col-form-label col-lg-12"> @lang('library.force_water_mark') </label>
                            <div class="col-lg-12">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value="1" class="form-check-input" name="force_water_mark" checked="">
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>
                    </div>



                </div>




            </div>
        </div>

        <div class="card-footer d-flex justify-content-end">
            <a  href='{{ route('board.library.index') }}' class="btn btn-light" id="reset"> @lang('library.cancel') </a>
            <button type="submit" class="btn btn-primary ms-3"> @lang('library.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
        </div>
    </form>
</div>
