<div class="row">
    <div class="col-md-12">
        <a href='{{ route('board.students.create') }}' class='btn btn-primary mb-2' style="float: left;">  <i class="icon-plus3 me-2"></i>  
            @lang('students.add new student')
        </a>
        <a class='btn btn-primary mb-2 me-2' data-bs-toggle="collapse" data-bs-target="#filters" aria-expanded="true"  style="float: left;">  
            <i class="icon-filter4 me-2"></i> 
        </a>
    </div>
    <div class="col-md-12 collapse" id='filters' wire:ignore.self >
        <div class="card card-body">

            <div class="d-sm-flex align-items-sm-start mt-2">

                <div class="dropdown ms-sm-3  mb-sm-0" wire:ignore >
                    <select wire:model.change='teacher_id' class="form-select teachers" data-width="250">
                        <option value=""> @lang('students.all teachers') </option>
                        @foreach ($this->teachers as $teacher)
                        <option value="{{ $teacher->id }}"> {{ $teacher->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="dropdown ms-sm-3  mb-sm-0" wire:ignore>
                    <select wire:model.change='course_id' class="form-select courses" data-width="250">
                        <option value=""> @lang('students.all courses') </option>
                        @foreach ($this->courses as $course)
                        <option value="{{ $course->id }}"> {{ $course->title }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="dropdown ms-sm-3  mb-sm-0" >
                    <select wire:model.change='unit_id' class="form-select" data-width="250">
                        <option value=""> @lang('students.all units') </option>
                        @foreach ($this->units as $unit)
                        <option value="{{ $unit->id }}"> {{ $unit->title }} </option>
                        @endforeach
                    </select>
                </div>


                <div class="dropdown ms-sm-3  mb-sm-0">
                    <button wire:click='resetFilters' type="button" class="btn btn-primary">
                        <i class="icon-reset  me-2"></i>
                        Reset Fillters
                    </button>
                </div>
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"> options </button>
                        <div class="dropdown-menu">
                            <a wire:click='loginFromAnotherDevice' class="dropdown-item"> login from another device  </a>
                            <a wire:click='ResetViews'  class="dropdown-item"> reset views </a>
                            <a data-bs-toggle="modal" data-bs-target="#views_manipulation_modal" class="dropdown-item">increase views</a>
                            <a wire:click='ZeroViews' class="dropdown-item"> zero views </a>

                            <a data-bs-toggle="modal" data-bs-target="#remove_courses_from_students_modal" class="dropdown-item"> remove courses </a>
                            <a data-bs-toggle="modal" data-bs-target="#allow_courses_modal" class="dropdown-item"> allow courses  </a>

                            <a data-bs-toggle="modal" data-bs-target="#disable_courses_modal" class="dropdown-item"> disable  courses</a>
                        </div>
                    </div>
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
            <div wire:loading> 
                <div class="card-overlay card-overlay-fadeout">
                    <span class="ph-spinner spinner"></span>
                    جارى التحقق من المواعيد برجاء الانتظار
                </div>
            </div>
            <table  class='table table-responsive table-xs text-center '>
                <thead>
                    <tr>
                        <th> 
                            <input  type="checkbox" class='form-check-input' wire:model.live='selectAll'  >
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
                    <tr class='{{ $student->isBanned() ? 'text-danger' : '' }}' id='student-{{ $student->id }}' >
                        <td> 
                            <div class="form-check form-check-reverse mb-2">
                                <input  type="checkbox" class="form-check-input"  wire:model.live='selectedStudents' value="{{ $student->id }}" >
                            </div>
                        </td>
                        <td> 
                            @if ($student->isBanned())
                            <i class="icon-bell-cross" data-bs-popup="tooltip" data-bs-placement="auto" data-bs-original-title="{{ $student->banning_message }}" ></i>
                            @endif
                            {{ $student->name }} 
                        </td>
                        <td> {{ $student->mobile }} </td>
                        <td> {{ $student->guardian_mobile }} </td>
                        <td> {{ $student->grade?->name }} </td>
                        <td> {{ $student->educationalSystem?->name }} </td>
                        <td>
                            @can('show student details')
                            <a href='{{ route('board.students.show' , $student ) }}' class='btn btn-sm btn-primary ' title="@lang('dashboard.view')" >  <i class="icon-eye "></i>  </a>
                            @endcan
                            <a class='btn btn-outline-dark btn-sm' href='{{ route('board.students.missing_payments.create' , $student ) }}'> <i class="icon-stack-plus "></i> </a>
                            @can('policy')
                            <a wire:click="$dispatchTo('board.students.change-student-password' ,  'open-modal' , { student_id: {{ $student->id }} } )"  class='btn btn-info btn-sm ' > <i class='icon-key '> </i>  </a>
                            @endcan
                            @can('policy')
                            <a href='{{ route('board.students.edit' , $student ) }}' class='btn btn-sm btn-warning ' title="@lang('dashboard.edit')" >  <i class="icon-database-edit2 "></i>  </a>
                            @endcan
                            @can('policy')
                            <a wire:click="$dispatch('deleteConfirmation', '{{ $student->id }}')" class='btn btn-sm btn-danger  delete_item' title="@lang('dashboard.delete')" >  <i class="icon-trash "></i>  </a>
                            @endcan
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

    <div id="views_manipulation_modal" class="modal fade" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> زياده عدد المشاهدات الى الطلاب </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit="IncreaseViews" class="form-horizontal">
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.videos') </label>
                            <div class="col-sm-9" >
                                <select wire:model.live='selectedVideos'  class="form-select" multiple> 
                                    @foreach ($this->lessons as $lesson)
                                    <optgroup label="{{ $lesson->title }}">
                                        @foreach ($lesson->videos as $video)
                                        <option value="{{ $video->id }}"> {{ $video->title }} -- {{ $video->id }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.videos') </label>
                            <div class="col-sm-9" >
                                <div class="form-check form-check-reverse mb-2">
                                    <label for="">
                                        <input  type="checkbox" class='form-check-input' wire:click='SelectAllVideosddddd'  id='ddsdsd4545' >
                                        @lang('videos.select all videos')
                                    </label>
                                </div> 
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.views') </label>
                            <div class="col-sm-9">
                                <input type="text" class='form-control' wire:model.live='allowed_views' >
                                @error('allowed_views')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal"> @lang('dashboard.cancel') </button>
                        <button type="submit" class="btn btn-primary"> @lang('dashboard.add') </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="remove_courses_from_students_modal" class="modal fade" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('students.remove  courses from students')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit="removeStudentsFromCourses" class="form-horizontal">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.course') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='selected_course_to_be_removed_id' class="form-select form-control @error('course_id') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($modal_courses as $modal_course)
                                    <option value="{{ $modal_course->id }}"> {{ $modal_course->title }} </option>
                                    @endforeach
                                </select>
                                @error('selected_course_to_be_removed_id')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>
                        </div>                    
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal"> @lang('dashboard.cancel') </button>
                        <button type="submit" class="btn btn-primary"> @lang('dashboard.remove') </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="allow_courses_modal" class="modal fade" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('students.enable course to student')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit="allowCourses" class="form-horizontal">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.course') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='selected_course_to_be_allowed_id' class="form-select form-control @error('selected_course_to_be_allowed_id') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($modal_courses as $modal_course)
                                    <option value="{{ $modal_course->id }}"> {{ $modal_course->title  }} </option>
                                    @endforeach
                                </select>
                                @error('selected_course_to_be_allowed_id')
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
                    <h5 class="modal-title">@lang('students.disable course from student')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit="disableCourses" class="form-horizontal">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.course') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='selected_course_to_be_disallowed_id' class="form-select form-control @error('course_id') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($modal_courses as $modal_course)
                                    <option value="{{ $modal_course->id }}"> {{ $modal_course->title }}  </option>
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


    @livewire('board.students.change-student-password')
</div>



@section('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/media/glightbox.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/gallery_library.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script>


<script>
    $(function() {

        $('.teachers').select2().on('select2:select', function (e) {
            @this.set('teacher_id', $('.teachers').select2("val"));
        });
        $('.courses').select2().on('select2:select', function (e) {
            @this.set('course_id', $('.courses').select2("val"));
        });
  {{--       $('.units').select2().on('select2:select', function (e) {
            @this.set('unit_id', $('.units').select2("val"));
        });
 --}}


        $('.teachers').on('change', function (e) {
            var data = $(this).select2("val");
            @this.set('teacher_id', data);
        });
        $('.courses').on('change', function (e) {
            var data = $(this).select2("val");
            @this.set('course_id', data);
        });
{{--         $('.units').on('change', function (e) {
            var data = $(this).select2("val");
            @this.set('unit_id', data);
        });
 --}}
        Livewire.on('studentAddedToCourse' , () => {
            $(document).find('#views_manipulation_modal').modal('hide');
            swalInit.fire({
                text: "@lang('dashboard.views icreased successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });

        Livewire.on('viewsUpdateSuccessfully' , () => {
            swalInit.fire({
                text: "@lang('dashboard.views updated successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });



        Livewire.on('devicesRemoved', () =>  {
            swalInit.fire({
                text: "@lang('dashboard.devices Removed successfully')" ,
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

{{-- 
        Livewire.on('open-add-views-modal' , () => {
            $(document).find('#add_new_course_to_student_modal').modal('show');
        });
         --}}
{{--         Livewire.on('close-add-views-modal' , () => {
            $(document).find('#add_new_course_to_student_modal').modal('hide');
        }); --}}

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