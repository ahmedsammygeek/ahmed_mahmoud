<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-sm-start">
                    <div class="form-control-feedback form-control-feedback-start flex-grow-1 mb-3 mb-sm-0">
                        <input type="text" wire:model.live='search' class="form-control" placeholder="Search ">
                        <div class="form-control-feedback-icon">
                            <i class="ph-magnifying-glass"></i>
                        </div>
                    </div>
                    <div class="dropdown ms-sm-3 mb-3 mb-sm-0">
                        <select wire:model='rows' class="form-select">
                            <option value="30">30 @lang('dashboard.rows')</option>
                            <option value="60">60 @lang('dashboard.rows') </option>
                            <option value="90">90 @lang('dashboard.rows') </option>
                            <option value="120">120 @lang('dashboard.rows') </option>
                            <option value="150">150 @lang('dashboard.rows') </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap text-center">
                    <thead>
                     @if (count($lessons))
                     <tr>
                        <th > @lang('courses.title') </th>
                        <th > @lang('courses.sorting') </th>
                        <th > @lang('courses.allowed_views') </th>
                        <th > @lang('courses.status') </th>
                        <th > @lang('courses.is free') </th>
                        <th class="text-center" style="width: 20px;"> @lang('dashboard.options') </th>
                    </tr>
                    @endif
                </thead>
                <tbody wire:sortable="updateLessonOrder">

                    @if (count($lessons))
                    @foreach ($lessons as $lesson)
                    <tr  wire:sortable.item="{{ $lesson->id }}" wire:key="lesson-{{ $lesson->id }}" >
                        <td class="text-wrap">
                            {{ $lesson->title }}
                        </td>
                        <td class="text-wrap">
                            {{ $lesson->sorting }}
                        </td>

                        <td class="text-wrap">
                            {{ $lesson->allowed_views }}
                        </td>
                        <td>
                            @switch($lesson->is_active )
                            @case(1)
                            <span class="badge bg-success"> @lang('courses.active') </span>
                            @break
                            @case(0)
                            <span class="badge bg-danger"> @lang('courses.inactive') </span>
                            @break
                            @endswitch
                        </td>

                        <td>
                            @switch($lesson->is_free )
                            @case(1)
                            <span class="badge bg-success"> @lang('dashboard.yes') </span>
                            @break
                            @case(0)
                            <span class="badge bg-danger"> @lang('dashboard.no') </span>
                            @break
                            @endswitch
                        </td>


                        <td class="text-center">
                            <a class='btn btn-sm btn-info ' title="@lang('dashboard.view')" >  <i class="icon-grab "></i>  </a>
                            <a  href="{{ route('board.courses.units.lessons.show'  ,  ['course' => $course  , 'unit' => $unit , 'lesson' => $lesson  ] ) }}"  class="btn btn-sm btn-primary  ">
                                <i class="icon-eye  "></i>
                            </a>
{{--                             <a  href="{{ route('board.courses.units.lessons.index'  ,  ['course' => $course  , 'unit' => $unit ] ) }}"  class="btn btn-sm btn-info  ">
                                <i class="icon-video-camera "></i>
                            </a> --}}
                            <a href="{{ route('board.courses.units.lessons.edit'  ,  ['course' => $course  , 'unit' => $unit , 'lesson' => $lesson ] ) }}"  class="btn btn-sm btn-warning ">
                                <i class="icon-database-edit2  "></i>
                            </a>
                            <a data-item_id='{{ $lesson->id }}' class="btn btn-danger btn-sm delete_item">
                                <i class="icon-trash  "></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach


                    @else
                    <tr>
                        <td class="text-center text-danger" colspan="5"> @lang('dashboard.no data to show') </td>
                    </tr>
                    @endif


                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-end ">
            {{ $lessons->links() }}
        </div>
    </div>
</div>
</div>

@section('scripts')
<script src="{{ Storage::url('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/media/glightbox.min.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/gallery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
<script>
    $(function() {

        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topLeft',
            type: 'alert',
            timeout: 2500
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

        Livewire.on('itemDeleted', () => {
            new Noty({
                text: "@lang('dashboard.deleted successfully')" ,
                type: 'info'
            }).show();
        })



        $(document).on('click', 'a.delete_item', function(event) {
            event.preventDefault();
            var item_id = $(this).attr('data-item_id');
            swalInit.fire({
                title: "@lang('dashboard.delete confirmation')",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "@lang('dashboard.yes delete')",
                cancelButtonText: "@lang('dashboard.cancel')",
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success'
                }
            }).then(function(result) {
                if(result.value) {
                   Livewire.dispatch('deleteItem' , {item_id} );
               }
           });

        });

    });
</script>
@endsection