<div class="row">
{{--     <div class="col-md-12">
        @livewire('board.students.add-new-course-to-student' , ['student' => $student ] )
    </div> --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('payments.show all payments') </h5>
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



    });
</script>
@endpush