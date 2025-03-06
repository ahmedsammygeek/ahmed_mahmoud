<div>
    <div class="col-lg-12">
        <div class="card">
            <div class='card-body'>

                <table class='table table-bordered table-responsive table-striped'>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('units.title') </th>
                            <th> @lang('units.added by') </th>
                            <th> @lang('units.created at') </th>
                            <th> @lang('units.allowed') </th>
                            <th> @lang('board.options') </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($student_units as $student_unit)
                        <tr>
                            <td> {{ $loop->index + 1 }} </td>
                            <td> {{ $student_unit->unit?->title }} -- {{ $student_unit->unit_id }} </td>
                            <td> {{ $student_unit->user?->name }} </td>
                            <td> {{ $student_unit->created_at }} </td>
                            <td>
                                @if ($student_unit->is_allowed)
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" wire:click='disallow({{ $student_unit->id }})' class="form-check-input " checked>
                                </div>
                                @else
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" wire:click='allow({{ $student_unit->id }})' class="form-check-input " >
                                </div>
                                @endif
                            </td>
                            <td>
                                <a wire:click="$dispatch('deleteConfirmation', '{{ $student_unit->id }}')" class='btn btn-sm btn-danger  delete_item' title="@lang('dashboard.delete')" >  <i class="icon-trash "></i>  </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>

                        </tr>

                    </tbody>
                </table>
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


        Livewire.on('updatedSuccessfully' , () => {
            swalInit.fire({
                text: "@lang('dashboard.changed successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });

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

@endpush