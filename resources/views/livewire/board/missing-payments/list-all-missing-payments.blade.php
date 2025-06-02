<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0">  عرض كافه الحسابات المفقوده  </h5>
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
                            <th> @lang('installments.student') </th>
                            <th> @lang('installments.course') </th>
                            <th> تم الاضافه بواسطه </th>
                            <th> المبلغ المدفوع </th>
                            <th> المبلغ المتبقى  </th>
                            <th> تاريخ الاضافه </th>
                        </tr>
                    </thead>
                    <tbody class='text-center center-block' >
                        @php
                        $i =1
                        @endphp
                        @foreach ($missing_payments as $missing_payment)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td>  <a href="{{ route('board.students.show' , $missing_payment->student_id ) }}"> {{ $missing_payment->student?->name}}  </a> </td>
                            <td>
                                {{ $missing_payment->course?->title }}
                            </td>
                            <td>
                                {{ $missing_payment->user?->name }}
                            </td>
                            <td>
                                {{ $missing_payment->paid_amount }} <span class='text-muted'> جنيه </span>
                            </td>
                            <td>
                                {{ $missing_payment->remains_amount }} <span class='text-muted'> جنيه </span>
                            </td>
                            <td>
                                {{ $missing_payment->created_at }} <span class='text-muted'> {{ $missing_payment->created_at->difFforHumans() }} </span>
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



        // $(document).on('click', 'input.disallow', function(event) {
        //     event.preventDefault();
        //     var course_id = $(this).attr('data-course_id');

        //     swalInit.fire({
        //         title: "@lang('dashboard.change confirmation')",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: "@lang('dashboard.yes change')",
        //         cancelButtonText: "@lang('dashboard.cancel')",
        //         buttonsStyling: false,
        //         customClass: {
        //             confirmButton: 'btn btn-success',
        //             cancelButton: 'btn btn-danger'
        //         }
        //     }).then(function(result) {
        //         if(result.value) {
        //             @this.set('student_course_id', course_id, true)
        //             $(document).find('#not_allow_message_modal').find('input[name="student_course_id"]').val(course_id);
        //             $(document).find('#not_allow_message_modal').modal('show');
        //         }
        //     });

        // });




        $(document).on('click', 'a.pay_this_installment', function(event) {
            event.preventDefault();
            var installment_id = $(this).attr('data-installment_id');
            swalInit.fire({
                title: "تاكيد الدفع",
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
                    Livewire.dispatch('pay' , {installment_id} );
                }
            });        
        });


    });
</script>
@endpush