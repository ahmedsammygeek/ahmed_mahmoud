<div class="row">
    <div class="col-md-12 collapse" id='filters' wire:ignore.self >
        <div class="card card-body">

            <div class="d-sm-flex align-items-sm-start mt-2">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('video.show all videos') </h5>
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
             <div class="d-sm-flex align-items-sm-start">
                <div class="form-control-feedback form-control-feedback-start flex-grow-1 mb-3 mb-sm-0">
                    <input type="text" wire:model.live.debounce.500ms='search' class="form-control" placeholder="البحث داخل الفديوهات">
                    <div class="form-control-feedback-icon">
                        <i class="ph-magnifying-glass"></i>
                    </div>
                </div>
            </div>
        </div>

        <table  class='table  table-responsive table-striped table-xs text-center '>
            <thead>
                <tr>
                    <th> # </th>
                    <th> @lang('videos.title') </th>
                    <th> @lang('videos.lesson') </th>
                    <th> @lang('videos.link') </th>
                    <th> @lang('videos.mintes') </th>
                    <th> @lang('videos.sorting') </th>
                    <th> @lang('videos.added_by') </th>
                    <th> @lang('videos.options') </th>
                </tr>
            </thead>
            <tbody wire:sortable="updateVideoOrder">
                @php
                $i =1
                @endphp
                @foreach ($videos as $video)
                <tr wire:sortable.item="{{ $video->id }}" wire:key="video-{{ $video->id }}">
                    <td> 
                        <a class='btn btn-sm btn-info ' title="@lang('dashboard.view')" >  <i class="icon-grab "></i>  </a>
                    </td>
                    <td> {{ $video->title }} </td>
                    <td> {{ $video->lesson?->title }} </td>
                    <td> <a target="_blank" href="{{ $video->lesson_video_link }}"> <i class='icon-youtube '>  </i> </a> </td>
                    <td> {{ $video->lesson_mins }} <span class="text-muted"> دقيقه </span> </td>
                    <td> 
                        @livewire('board.videos.sort-video-by-input' , ['video' => $video] , key($video->id) )
                    </td>
                    <td> {{ $video->user?->name }} </td>
                    <td>


                        <a href='{{ route('board.videos.show' , $video ) }}' class='btn btn-sm btn-primary ' title="@lang('dashboard.view')" >  <i class="icon-eye "></i>  </a>
                        <a href='{{ route('board.videos.edit' , $video ) }}' class='btn btn-sm btn-warning ' title="@lang('dashboard.edit')" >  <i class="icon-database-edit2 "></i>  </a>
                        <a wire:click="$dispatch('deleteConfirmation', '{{ $video->id }}')" class='btn btn-sm btn-danger  delete_item' title="@lang('dashboard.delete')" >  <i class="icon-trash "></i>  </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
            <div class="pagination hstack gap-3">

            </div>

            {{ $videos->links() }}
        </div>
    </div>
</div>
</div>



@section('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
{{-- <script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script> --}}
{{-- <script src="{{ asset('board_assets/assets/demo/pages/form_select2.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>


<script>
    $(function() {



        // $('.select2').select2();

        // document.addEventListener("livewire:initialized", () => {

            // alert('ff');
            // $(".select2").select2()
            // .on("select2:select", function () {
            //     const values = $(this).val();
            //     console.log(values);
            //     @this.set("course_id", values);
            // });
        // });


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




    });
</script>
@endsection