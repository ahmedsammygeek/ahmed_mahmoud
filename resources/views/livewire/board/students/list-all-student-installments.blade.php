<div class="row">
{{--     <div class="col-md-12">
        @livewire('board.students.add-new-course-to-student' , ['student' => $student ] )
    </div> --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('installments.show all student installments') </h5>
                <div class="ms-sm-auto my-sm-auto">
                    <select wire:model.live='rows' class="form-select ">
                        <option value="2">2 @lang('dashboard.rows') </option>
                        <option value="15">15 @lang('dashboard.rows') </option>
                        <option value="30">30 @lang('dashboard.rows') </option>
                        <option value="50">50 @lang('dashboard.rows') </option>
                        <option value="70">70 @lang('dashboard.rows') </option>
                        <option value="100">100 @lang('dashboard.rows') </option>
                    </select>
                </div>
            </div>
            <div class='card-body' >
                <table  class='table  table-responsive table-striped table-xs text-center '>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('installments.course') </th>
                            <th> @lang('installments.user') </th>
                            <th> @lang('installments.amount') </th>
                            <th> @lang('installments.is_paid') </th>
                            <th> @lang('installments.due_date') </th>
                            <th> @lang('installments.change_to_paid_by') </th>
                            <th> @lang('installments.options') </th>
                        </tr>
                    </thead>
                    <tbody class='text-center center-block' >
                        @php
                        $i =1
                        @endphp
                        @foreach ($installments as $installment)
                        <tr>
                            <td> {{ $i++ }} </td>
                            
                            <td>
                                {{ $installment->course?->title }}
                            </td>
                            <td>
                                {{ $installment->user?->name }}
                            </td>
                            <td>
                                {{ $installment->amount }} <span class='text-muted'> جنيه </span>
                            </td>
                            <td>
                                @switch($installment->is_paid)
                                    @case(0)
                                    <span class='badge bg-danger' > @lang('installments.unpaid') </span>
                                    @break
                                    @case(1)
                                    <span class='badge bg-success' > @lang('installments.paid') </span>
                                    @break
                                @endswitch 
                            </td>
                            <td>
                                {{ $installment->due_date }}
                            </td>
                            <td>
                                {{ $installment->ChangeToPaidBy?->name }}
                            </td>
                            



                            <td>
                                <a class='btn btn-sm btn-primary ' title='مشاهده' href="{{ route('board.installments.show' , $installment ) }}" >  
                                    <i class="icon-eye "></i>  
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
            </div>
        </div>
    </div>
    <div id="not_allow_message_modal" wire:ignore.self class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('courses.disallow reason') </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit="disallow" class="form-horizontal">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('courses.reason') </label>
                            <div class="col-sm-9">
                                <input type="text" wire:model.live='not_allow_message' class="form-control @error('not_allow_message') is-invalid @enderror ">
                                @error('not_allow_message')
                                <p class="is-invalid"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal"> @lang('dashboard.cancel') </button>
                        <button type="submit" class="btn btn-primary"> @lang('dashboard.edit') </button>
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

        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });


        Livewire.on('changed' , () => {
            $(document).find('#not_allow_message_modal').modal('hide');
            swalInit.fire({
                text: "@lang('dashboard.changed successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });
        Livewire.on('deleted' , () => {

            swalInit.fire({
                text: "@lang('dashboard.deleted successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });



        $(document).on('click', 'input.disallow', function(event) {
            event.preventDefault();
            var course_id = $(this).attr('data-course_id');

            swalInit.fire({
                title: "@lang('dashboard.change confirmation')",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "@lang('dashboard.yes change')",
                cancelButtonText: "@lang('dashboard.cancel')",
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(result) {
                if(result.value) {
                    @this.set('student_course_id', course_id, true)
                    $(document).find('#not_allow_message_modal').find('input[name="student_course_id"]').val(course_id);
                    $(document).find('#not_allow_message_modal').modal('show');
                }
            });

        });


        $(document).on('click', 'input.allow', function(event) {
            event.preventDefault();
            var course_id = $(this).attr('data-course_id');
            swalInit.fire({
                title: "@lang('dashboard.change confirmation')",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "@lang('dashboard.yes change')",
                cancelButtonText: "@lang('dashboard.cancel')",
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(result) {
                if(result.value) {
                    Livewire.dispatch('allowStudentToWatchCourse' , {course_id} );
                }
            });        
        });



        $(document).on('click', 'a.delete_item', function(event) {
            event.preventDefault();
            var item_id = $(this).attr('data-item_id');
            swalInit.fire({
                title: "@lang('dashboard.delete confirmation')",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "@lang('dashboard.yes change')",
                cancelButtonText: "@lang('dashboard.cancel')",
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(result) {
                if(result.value) {
                    Livewire.dispatch('deleteStudentCourse' , {item_id} );
                }
            });        
        });


    });
</script>
@endpush