<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('dashboard_notifications.show all dashboard_notifications') </h5>
                <div class="ms-sm-auto my-sm-auto">
                    <select wire:model.live='rows' class="form-select ">
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
                            <th> @lang('dashboard_notifications.title') </th>
                            <th> @lang('dashboard_notifications.content') </th>
                            <th> @lang('dashboard_notifications.send by') </th>
                            <th> @lang('dashboard_notifications.send date') </th>
                            <th> @lang('dashboard_notifications.options') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1
                        @endphp
                        @foreach ($notifications as $notification)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $notification->title }} </td>
                            <td> {{ $notification->content }} </td>
                            <td> {{ $notification->user?->name }} </td>
                            <td> {{ $notification->created_at }} </td>
                            <td>
                                <a href='{{ route('board.dashboard_notifications.show' , $notification ) }}' class='btn btn-sm btn-primary ' title="@lang('dashboard.view')" >  <i class="icon-eye "></i>  </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
                <div class="pagination hstack gap-3">

                </div>

                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>



@section('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>

@endsection