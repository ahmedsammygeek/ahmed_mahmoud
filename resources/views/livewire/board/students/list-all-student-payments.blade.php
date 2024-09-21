<div class="row">
{{--     <div class="col-md-12">
        @livewire('board.students.add-new-course-to-student' , ['student' => $student ] )
    </div> --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('payments.show all student payments') </h5>
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
                            <th> @lang('payments.student') </th>
                            <th> @lang('payments.course') </th>
                            <th> @lang('payments.user') </th>
                            <th> @lang('payments.type') </th>
                            <th> @lang('payments.amount') </th>
                            <th> @lang('payments.created_at') </th>
                            <th> @lang('payments.options') </th>
                        </tr>
                    </thead>
                    <tbody class='text-center center-block' >
                        @php
                        $i =1
                        @endphp
                        @foreach ($payments as $payment)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $payment->student?->name}} </td>
                            <td>
                                {{ $payment->course?->title }}
                            </td>
                            <td>
                                {{ $payment->user?->name }}
                            </td>
                            <td>
                                @switch($payment->type)
                                    @case(1)
                                    <span class='badge bg-primary' > @lang('payments.purchase') </span>
                                    @break
                                    @case(2)
                                    <span class='badge bg-success' > @lang('payments.installment payment') </span>
                                    @break
                                @endswitch 
                            </td>
                            <td>
                                {{ $payment->amount }} <span class='text-muted'> جنيه </span>
                            </td>


                            <td>
                                {{ $payment->created_at }}
                            </td>

                            <td>
                                <a class='btn btn-sm btn-primary ' title='مشاهده' href="{{ route('board.payments.show' , $payment ) }}" >  
                                    <i class="icon-eye "></i>  
                                </a>

                                <a class='btn btn-sm btn-danger delete_item ' title='حذف' data-item_id="{{ $payment->id }}"  >  
                                    <i class="icon-trash "></i>  
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

        Livewire.on('paymentDeleted' , () => {
            swalInit.fire({
                text: "@lang('dashboard.payment successfully')" ,
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
                    Livewire.dispatch('delete-payment' , {item_id} );
                }
            });        
        });


    });
</script>
@endpush