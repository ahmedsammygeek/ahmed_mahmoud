<div class="mb-4">
                        <div class="fw-bold border-bottom pb-2 mb-3">  @lang('dashboard_notifications.notification details') </div>


                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3"> @lang('dashboard_notifications.title in arabic') <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control @error('title_ar')  is-invalid @enderror" required placeholder="">
                                @error('title_ar')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3"> @lang('dashboard_notifications.title in english') <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="title_en" value="{{ old('title_en') }}" class="form-control @error('title_en')  is-invalid @enderror" required placeholder="">
                                @error('title_en')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3"> @lang('dashboard_notifications.content in arabic') <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="content_ar" value="{{ old('content_ar') }}" class="form-control @error('content_ar')  is-invalid @enderror" required placeholder="">
                                @error('content_ar')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3"> @lang('dashboard_notifications.content in english') <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="content_en" value="{{ old('content_en') }}" class="form-control @error('content_en')  is-invalid @enderror" required placeholder="">
                                @error('content_en')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3"> @lang('dashboard_notifications.grade') <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="grade_id" wire:model.live='grade_id' class='form-control form-select'>
                                    <option value=""></option>
                                    @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}"> {{ $grade->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3"> @lang('dashboard_notifications.courses') <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select   wire:model.live='course_id' class='form-control form-select'>
                                    <option value=""></option>
                                    @foreach ($this->courses as $course)
                                    <option value="{{ $course->id }}"> {{ $course->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3"> @lang('dashboard_notifications.students') <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="students" wire:model.live='selected_students' class='form-control form-select select'>
                                    @foreach ($this->students as $student)
                                    <option value="{{ $student->id }}"> {{ $student->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>