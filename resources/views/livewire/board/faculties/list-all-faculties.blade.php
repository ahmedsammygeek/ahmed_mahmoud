<div class="row">
    <div class="col-md-12">
        <a href='{{ route('board.faculties.create') }}' class='btn btn-primary mb-2' style="float: left;">  <i class="icon-plus3 me-2"></i>  
            @lang('faculties.add new faculty')
        </a>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('universities.show all universities') </h5>
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
                <table  class='table  table-responsive table-striped table-xs text-center '>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('faculties.name in arabic') </th>
                            <th> @lang('faculties.name in english') </th>
                            <th> @lang('dashboard.added by') </th>
                            <th> @lang('faculties.status') </th>
                            <th> @lang('dashboard.options') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1
                        @endphp
                        @foreach ($faculties as $faculty)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $faculty->getTranslation('name'  , 'ar') }} </td>
                            <td> {{ $faculty->getTranslation('name'  , 'en') }} </td>
                            <td> {{ $faculty->user?->name }} </td>
                            <td> 
                                @switch($faculty->is_active)
                                    @case(1)
                                    <span class='badge bg-primary' > @lang('dashboard.active') </span>
                                    @break
                                    @case(0)
                                    <span  class='badge bg-danger'> @lang('dashboard.inactive') </span>
                                    @break
                                @endswitch
                                
                            </td>
                            <td>
                                 <a href='{{ route('board.faculties.show' , $faculty ) }}' class='btn btn-sm btn-primary ' title="@lang('dashboard.view')" >  <i class="icon-eye "></i>  </a>


                                <a href='{{ route('board.faculties.edit' , $faculty ) }}' class='btn btn-sm btn-warning ' title="@lang('dashboard.edit')" >  <i class="icon-database-edit2 "></i>  </a>

                                <a wire:click="$dispatch('deleteConfirmation', '{{ $faculty->id }}')" class='btn btn-sm btn-danger  delete_item' title="@lang('dashboard.delete')" >  <i class="icon-trash "></i>  </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
                <div class="pagination hstack gap-3">

                </div>

                {{ $faculties->links() }}
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