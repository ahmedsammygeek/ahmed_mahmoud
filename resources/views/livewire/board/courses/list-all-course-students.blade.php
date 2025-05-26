
<div class="container-fulid">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group mt-3">
                <label class="form-label" for=""> الوحده : </label>
                <select wire:model.live='unit_id' class='form-control form-select' >
                    <option value=""> جميع الطلاب </option>
                    @foreach ($units as $unit)
                    <option value="{{ $unit->id }}"> طلاب الــ {{ $unit->title }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group mt-3">
                <label class="form-label" for=""> خصائص : </label> <br>
                <button wire:click='removeStudentFromCourse' class="btn btn-danger"> remove from course </button>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group mt-3">
                <label  class="form-label" for=""> عدد الطلاب </label>
                <span class="badge bg-primary mt-2"> {{ $students->count() }} </span>
            </div>
        </div>
    </div>    
    <div class="row mt-3">
        @foreach ($students as $student)
        <div class="col-xl-3 col-lg-6">
            <div class="card card-body">

                <div class="d-flex">
                    <a href="#" class="me-3">
                        <img src="{{ Storage::url('students/'.$student->profile_picture) }}" class="rounded-circle" width="44" height="44" alt="">
                    </a>

                    <div class="flex-fill">
                        <h6 class="mb-0">
                            <input type="checkbox" id="dc_ls_c{{ $student->id }}"  wire:model.live='selectedStudents' value="{{ $student->id }}" >
                            <label class="ms-2" for="dc_ls_c{{ $student->id }}">{{ $student->name }}</label>
                        </h6>
                        <span class="text-muted"> {{ $student->mobile }} </span>
                    </div>

                    <div class="align-self-center ms-3" >
                        <div class="dropdown" >
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('board.students.show' , $student ) }}" class="dropdown-item">
                                    <i class="ph-user-circle  me-2"></i>
                                    الملف الشخصى
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-md-12">
            {{ $students->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/media/glightbox.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/gallery_library.js') }}"></script>


<script>
    $(function() {


        Livewire.on('studentDeletedFromCourse', () =>  {
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
                icon: 'danger',
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
                    Livewire.dispatch('removeStudentFromCourse' , {itemId} );
                }
            });
        })




    });
</script>
@endpush