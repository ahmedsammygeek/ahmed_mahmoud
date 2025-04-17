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
                    <select wire:model.change='teacher_id' class="form-select">
                        <option value=""> @lang('students.all teachers') </option>
                        @foreach ($this->teachers as $teacher)
                        <option value="{{ $teacher->id }}"> {{ $teacher->name }} </option>
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
                    <select wire:model.change='studentsUnits' class="form-select" multiple="" >

                        @foreach ($this->units as $unit)
                        <option value="{{ $unit->id }}"> {{ $unit->title }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="dropdown ms-sm-3  mb-sm-0">
                    <button wire:click='resetFilters' class="btn btn-primary "> reset filters </button>
                </div>

                <div class="dropdown ms-sm-3  mb-sm-0">
                    {{-- <button wire:click='addUnitsToStudents' class="btn btn-primary "> add units  </button> --}}
                    <button data-bs-toggle="modal" data-bs-target="#add_units_to_student_modal"  class="btn btn-primary "> add units  </button>
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
        <table  class='table  table-responsive table-striped table-xs text-center '>
            <thead>
                <tr>
                    <th> 
                        <input  type="checkbox" class='form-check-input'  wire:click='selectAllStudents' id='ddsdsd' >
                    </th>
                    <th> @lang('students.name') </th>
                    <th> @lang('students.mobile') </th>
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
                            <input  type="checkbox" class="form-check-input"  wire:model.live='selectedStudents' value="{{ $student->id }}" >
                        </div>
                    </td>
                    <td> {{ $student->name }} </td>
                    <td> {{ $student->mobile }} </td>
                    <td>
                        <a href='{{ route('board.students.show' , $student ) }}' class='btn btn-sm btn-primary ' title="@lang('dashboard.view')" >  <i class="icon-eye "></i>  </a>
                        <a href='{{ route('board.students.edit' , $student ) }}' class='btn btn-sm btn-warning ' title="@lang('dashboard.edit')" >  <i class="icon-database-edit2 "></i>  </a>
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
<div id="add_units_to_student_modal" class="modal fade" wire:ignore.self tabindex="-1">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @lang('students.add units to student')
                    <button type="button" class="btn btn-success add_more_courses" wire:click='AddMoreCourses' >   
                        <i class="icon-plus3 me-2"></i>  
                    </button>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit="addUnitsToStudents" class="form-horizontal">
                <div class="modal-body">


                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.teacher') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='choosed_teacher_id' class="form-select form-control @error('choosed_teacher_id') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($this->choosed_teachers as $choosed_teacher)
                                    <option value="{{ $choosed_teacher->id }}"> {{ $choosed_teacher->name }} </option>
                                    @endforeach
                                </select>
                                @error('choosed_teacher_id')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('students.course') </label>
                            <div class="col-sm-9">
                                <select wire:model.live='choosed_course_id' class="form-select form-control @error('choosed_course_id') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($this->choosed_courses as $choosed_course)
                                    <option value="{{ $choosed_course->id }}"> {{ $choosed_course->title }} </option>
                                    @endforeach
                                </select>
                                @error('choosed_course_id')
                                <p class='is-invalid text-danger'> {{ $message }} </p>
                                @enderror 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> الاجزاء </label>
                            <div class="col-sm-9">
                                <select wire:model.live='selectedUnits' multiple="multiple" class="form-select form-control @error('selectedUnits') is-invalid @enderror " id="">
                                    <option value=""></option>
                                    @foreach ($this->choosed_units as $choosed_unit)
                                    <option value="{{ $choosed_unit->id }}"> {{ $choosed_unit->title }} </option>
                                    @endforeach
                                </select>
                                @error('selectedUnits')
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

</div>



@section('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/media/glightbox.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/gallery_library.js') }}"></script>

<script>
    $(function() {



        Livewire.on('unitsAdded', () =>  {

            $(document).find('#add_units_to_student_modal').modal('hide');
            swalInit.fire({
                text: "@lang('dashboard.units added to students successfully')" ,
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
    });
</script>
@endsection