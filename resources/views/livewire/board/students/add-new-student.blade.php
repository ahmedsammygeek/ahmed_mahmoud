<div class="mb-4">
    <div class="fw-bold border-bottom pb-2 mb-3"> @lang('students.student details') </div>
    <div class="row mb-3">
        <label class="col-form-label col-lg-2"> @lang('students.name') <span class="text-danger">*</span></label>
        <div class="col-lg-10">
            <input type="text" name="name" wire:model.live='name' class="form-control @error('name')  is-invalid @enderror" required placeholder="">
            @error('name')
            <p class='text-danger' > {{ $message }} </p>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-form-label col-lg-2"> @lang('students.mobile') <span class="text-danger">*</span></label>
        <div class="col-lg-10">
            <input type="text" name="mobile" wire:model.live='mobile' class="form-control @error('mobile')  is-invalid @enderror" required placeholder="">
            @error('mobile')
            <p class='text-danger' > {{ $message }} </p>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-form-label col-lg-2"> @lang('students.guardian mobile') <span class="text-danger">*</span></label>
        <div class="col-lg-10">
            <input type="text" name="guardian_mobile" wire:model.live='guardian_mobile' class="form-control @error('guardian_mobile')  is-invalid @enderror" required placeholder="">
            @error('guardian_mobile')
            <p class='text-danger' > {{ $message }} </p>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-form-label col-lg-2"> @lang('students.grade') <span class="text-danger">*</span></label>
        <div class="col-lg-10">
            <select name="grade" wire:model.live='grade' class="form-control form-select" id="">
                @foreach ($grades as $grade)
                <option value="{{ $grade->id }}"> {{ $grade->name }} </option>
                @endforeach
            </select>
            @error('grade')
            <p class='text-danger' > {{ $message }} </p>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-form-label col-lg-2"> @lang('students.educational system') <span class="text-danger">*</span></label>
        <div class="col-lg-10">
            <select name="educational_system_id" wire:model.live='educational_system_id' class="form-control form-select" id="">
                @foreach ($systems as $system)
                <option value="{{ $system->id }}"> {{ $system->name }} </option>
                @endforeach
            </select>
            @error('system')
            <p class='text-danger' > {{ $message }} </p>
            @enderror
        </div>
    </div>


    <div class="row mb-3">
        <label class="col-form-label col-lg-2"> @lang('students.student type') <span class="text-danger">*</span></label>
        <div class="col-lg-10">
            <select name="student_type" wire:model.change='student_type' class="form-control form-select" id="">
                <option value="1" @selected(old('student_type') == 1 )  > @lang('students.only center student') </option>
                <option value="2" @selected(old('student_type') == 2 )  > @lang('students.only mobile student') </option>
                <option value="3" @selected(old('student_type') == 3 )  > @lang('students.student can use both') </option>
            </select>
            @error('student_type')
            <p class='text-danger' > {{ $message }} </p>
            @enderror
        </div>
    </div>



    @if ($student_type  == 2 || $student_type == 3 )
    <div class="fw-bold border-bottom pb-2 mb-3"> @lang('students.login details') </div>

    <div class="row mb-3">
        <label class="col-form-label col-lg-2"> @lang('students.password')  <span class="text-danger">*</span></label>
        <div class="col-lg-10">
            <input type="password" name="password" id="password" class="form-control" >
            @error('password')
            <p class='text-danger' > {{ $message }} </p>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-form-label col-lg-2">  @lang('students.password confirmation') <span class="text-danger">*</span></label>
        <div class="col-lg-10">
            <input type="password" name="password_confirmation" class="form-control" >
            @error('password_confirmation')
            <p class='text-danger' > {{ $message }} </p>
            @enderror
        </div>
    </div>
    @endif

</div>