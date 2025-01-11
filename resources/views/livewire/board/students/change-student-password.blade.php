<div>
    <div id="password_modal" class="modal fade" tabindex="-1" wire:ignore.self >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">  @lang('students.change password for') : {{ $student->name }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit="save" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label"> @lang('students.password') </label>
                                    <input type="password" wire:model.live='password' class="form-control">
                                    @error('password')
                                    <p class="text-danger"> {{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label"> @lang('students.password confirmation') </label>
                                    <input type="password" wire:model.live='password_confirmation' class="form-control">
                                    @error('password_confirmation')
                                    <p class="text-danger"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal"> @lang('board.cancel') </button>
                        <button type="submit" class="btn btn-primary"> @lang('board.edit') </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@script
<script>
    const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });
    $wire.on('open-modal', () => {
        $(document).find('#password_modal').modal('show');
    });

    $wire.on('passwordUpdated', () => {
        $(document).find('#password_modal').modal('hide');

         swalInit.fire({
                text: "@lang('dashboard.password updated successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
    });
</script>
@endscript