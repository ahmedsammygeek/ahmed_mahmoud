<div class="row">
    <div class="col-md-12">

        <a class='btn btn-primary mb-2 me-2' data-bs-toggle="collapse" data-bs-target="#filters" aria-expanded="true"  style="float: left;">  
            <i class="icon-filter4 me-2"></i> 
        </a>
    </div>
    <div class="col-md-12 collapse" id='filters' wire:ignore.self >
        <div class="card card-body">

            <div class="d-sm-flex align-items-sm-start mt-2">
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='grade_id' class="form-select">
                        <option value=""> @lang('students.all grades') </option>
                        @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}"> {{ $grade->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='educational_system_id' class="form-select">
                        <option value=""> @lang('students.all educational systems') </option>
                        @foreach ($systems as $system)
                        <option value="{{ $system->id }}"> {{ $system->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='course_id' class="form-select">
                        <option value=""> @lang('students.all courses') </option>
                        @foreach ($this->courses as $course)
                        <option value="{{ $course->id }}"> {{ $course->title }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='teacher_id' class="form-select">
                        <option value=""> @lang('students.all teachers') </option>
                        @foreach ($this->teachers as $teacher)
                        <option value="{{ $teacher->id }}"> {{ $teacher->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='student_type' class="form-select">
                        <option value=""> @lang('students.all students') </option>
                        <option value="1"> @lang('students.only center students') </option>
                        <option value="2"> @lang('students.only online students') </option>
                    </select>
                </div>
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <button  data-bs-toggle="modal" data-bs-target="#allow_courses_modal"  class="btn btn-primary "> allow </button>
                    <button  data-bs-toggle="modal" data-bs-target="#disable_courses_modal"  class="btn btn-primary "> disable </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('students.show all students') </h5>
                <div class="ms-sm-auto my-sm-auto">
                    <select wire:model.live='rows' class="form-select ">
                        {{-- <option value="2">2 @lang('dashboard.rows') </option> --}}
                        <option value="15">15 @lang('dashboard.rows') </option>
                        <option value="30">30 @lang('dashboard.rows') </option>
                        <option value="50">50 @lang('dashboard.rows') </option>
                        <option value="70">70 @lang('dashboard.rows') </option>
                        <option value="100">100 @lang('dashboard.rows') </option>
                    </select>
                </div>
            </div>
            <div class='card-body' >
               <div class="d-sm-flex align-items-sm-start">
                <div class="form-control-feedback form-control-feedback-start flex-grow-1 mb-3 mb-sm-0">
                    <input type="text" wire:model.live.debounce.500ms='search' class="form-control" placeholder="البحث داخل الطلاب">
                    <div class="form-control-feedback-icon">
                        <i class="ph-magnifying-glass"></i>
                    </div>
                </div>
            </div>
        </div>
{{--         <div wire:loading> 
            <div class="card-overlay card-overlay-fadeout">
                <span class="ph-spinner spinner"></span>
                جارى التحقق من المواعيد برجاء الانتظار
            </div>
        </div> --}}
        <table  class='table  table-responsive table-striped table-xs text-center '>
            <thead>
                <tr>
                    <th> 
                         <div class="form-check form-check-reverse mb-2">
                            <input  type="checkbox" class='form-check-input'  wire:click='selectAllStudents' id='ddsdsd' >
                        </div> 
                    </th>
                    <th> @lang('students.name') </th>
                    <th> @lang('students.mobile') </th>
                    <th> @lang('students.guardian mobile') </th>
                    <th> @lang('students.grade') </th>
                    <th> @lang('students.educational system') </th>
                    <th> @lang('students.options') </th>
                </tr>
            </thead>
            <tbody>
                @php
                $i =1
                @endphp
                @foreach ($students as $student)
                <tr id='student-{{ $student->id }}'>
                    <td>
                        <div class="form-check form-check-reverse mb-2">
                            <input  type="checkbox" class="form-check-input"  wire:model.live='selectedStudents' value="{{ $student->id }}"  >
                        </div>
                    </td>
                    <td> {{ $student->name }} </td>
                    <td> {{ $student->mobile }} </td>
                    <td> {{ $student->guardian_mobile }} </td>
                    <td> {{ $student->grade?->name }} </td>
                    <td> {{ $student->educationalSystem?->name }} </td>
                    <td>
                        <a href='{{ route('board.students.show' , $student ) }}' class='btn btn-sm btn-primary ' title="@lang('dashboard.view')" >  <i class="icon-eye "></i>  </a>
                        <a href='{{ route('board.students.edit' , $student ) }}' class='btn btn-sm btn-warning ' title="@lang('dashboard.edit')" >  <i class="icon-database-edit2 "></i>  </a>
                        <a wire:click="$dispatch('deleteConfirmation', '{{ $student->id }}')" class='btn btn-sm btn-danger  delete_item' title="@lang('dashboard.delete')" >  <i class="icon-trash "></i>  </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
            <div class="pagination hstack gap-3">

            </div>

            {{ $students->links() }}
        </div>
    </div>
</div>

<div id="allow_courses_modal" class="modal fade" wire:ignore.self tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('students.add new course to student')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit="allowCourses" class="form-horizontal">
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3"> @lang('students.course') </label>
                        <div class="col-sm-9">
                            <select wire:model.live='selected_course_id' class="form-select form-control @error('selected_course_id') is-invalid @enderror " id="">
                                <option value=""></option>
                                @foreach ($selectedCourses as $selectedCourse)
                                <option value="{{ $selectedCourse->id }}"> {{ $selectedCourse->title }} -- {{ $selectedCourse->id }} </option>
                                @endforeach
                            </select>
                            @error('selected_course_id')
                            <p class='is-invalid text-danger'> {{ $message }} </p>
                            @enderror 
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal"> @lang('dashboard.cancel') </button>
                    <button type="submit" class="btn btn-primary"> المساح بالمشاهده </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="disable_courses_modal" class="modal fade" wire:ignore.self tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('students.add new course to student')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit="disableCourses" class="form-horizontal">
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3"> @lang('students.course') </label>
                        <div class="col-sm-9">
                            <select wire:model.live='selected_course_id' class="form-select form-control @error('course_id') is-invalid @enderror " id="">
                                <option value=""></option>
                                @foreach ($selectedCourses as $selectedCourse)
                                <option value="{{ $selectedCourse->id }}"> {{ $selectedCourse->title }} -- {{ $selectedCourse->id }} </option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <p class='is-invalid text-danger'> {{ $message }} </p>
                            @enderror 
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3"> @lang('students.reason') </label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.live='disable_reason' class='form-control' placeholder="disable reason" >
                            @error('reason')
                            <p class='is-invalid text-danger'> {{ $message }} </p>
                            @enderror 
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal"> @lang('dashboard.cancel') </button>
                    <button type="submit" class="btn btn-primary"> منع بالمشاهده </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>



@section('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/media/glightbox.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/gallery_library.js') }}"></script>


<script>
    $(function() {



        Livewire.on('courseAllowededToStudents' , () => {
            $(document).find('#allow_courses_modal').modal('hide');
            swalInit.fire({
                text: "@lang('dashboard.courses alloweded successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });
        Livewire.on('courseDisabldToStudents' , () => {
            $(document).find('#disable_courses_modal').modal('hide');
            swalInit.fire({
                text: "@lang('dashboard.courses disabled successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });


        Livewire.on('itemDeleted', () =>  {
            swalInit.fire({
                text: "@lang('dashboard.deleted successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });

        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });


        Livewire.on('deleteConfirmation', (itemId) => {
            swalInit.fire({
                title: "@lang('dashboard.delete confirmation')",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "@lang('dashboard.yes delete')",
                cancelButtonText: "@lang('dashboard.cancel')",
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(result) {
                if(result.value) {
                    Livewire.dispatch('deleteItem' , {itemId} );
                }
            });
        })




    });
</script>
@endsection