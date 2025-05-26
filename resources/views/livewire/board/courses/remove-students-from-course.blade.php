<div style='display: inline;' >
    <a data-bs-toggle="modal" data-bs-target="#modal_form_vertical{{ $course->id }}" class='btn btn-danger btn-sm'> <i class="icon-users ">  </i > </a>


    <div id="modal_form_vertical{{ $course->id }}" class="modal fade" tabindex="-1" wire:ignore.self >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">حذف الطلاب من الكورس </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit="removeAllStudents" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label"> الوحدات </label>
                                    <select class='form-control form-select' wire:model.live='unit_id' multiple >
                                        @foreach ($units as $unit)
                                           <option value="{{ $unit->id }}" > {{ $unit->title }} </option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal"> تراجع </button>
                        <button type="submit" class="btn btn-primary"> حذف الطلاب </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script>
    $(document).ready(function() {
                Livewire.on('studentDeletedFromCourse', () =>  {
            $(document).find('#modal_form_vertical{{ $course->id }}').modal('hide');
            swalInit.fire({
                text: "@lang('dashboard.students  successfully removed from course units ')" ,
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
@endpush