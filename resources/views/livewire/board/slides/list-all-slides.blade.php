<div>
    <div class="row">
        <div class="col-md-12">
            <a href='{{ route('board.slides.create') }}' class='btn btn-primary mb-2' style="float: left;">  <i class="icon-plus3  me-2"></i>  إضافه صوره جديد </a>

            <a  class='btn btn-primary mb-2 ' data-bs-toggle="collapse" data-bs-target="#filters" style="float: left; margin-left: 4px;">
                <i  class='icon-filter3 ' >  </i>
            </a>
        </div>
        <div class="col-md-12 collapse" id="filters" wire:ignore.self>
            <div class="card">
                <div class="card-body d-sm-flex">
                    <div class="ms-sm-3">
                        <select wire:model='is_active' class="form-select wmin-sm-200 mb-3 mb-sm-0">
                            <option value="all"> جميع الصور </option>
                            <option value="1">فعال</option>
                            <option value="0">غير فعال</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('board.layouts.messages')
    <div class="row">
        @foreach ($slides as $slide)
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-img-actions mx-1 mt-1">
                    <img class="card-img img-fluid" src="{{ Storage::url('slides/'.$slide->image) }}" alt="">
                    <div class="card-img-actions-overlay card-img">
                        <a href="{{ Storage::url('slides/'.$slide->image) }}" class="btn btn-outline-white btn-icon rounded-pill" data-bs-popup="lightbox" data-gallery="gallery1">
                            <i class="ph-plus"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex align-items-start flex-nowrap">
                        <div>
                            <div class="fw-semibold me-2"> ترتيب العرض : {{ $slide->order }} </div>
                            @if ($slide->is_active)
                            <span class='badge bg-success fs-sm ' > فعال</span>
                            @else
                            <span class='badge bg-danger fs-sm ' > غير فعال </span>
                            @endif
                        </div>

                        <div class="d-inline-flex ms-auto">
                            <a href="{{ route('board.slides.show' , $slide ) }}" class="text-body ms-2"><i class="icon-eye text-primary"></i></a>
                            <a href="{{ route('board.slides.edit' , $slide ) }}" class="text-body ms-2"><i class="icon-database-edit2  text-warning"></i></a>
                            <a wire:click="$emit('deleteConfirmation', '{{ $slide->id }}')" class="text-body delete_item ms-2">
                                <i class="icon-trash text-danger "></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@section('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/media/glightbox.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/gallery.js') }}"></script>
<script>
    $(function() {


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
                title: 'تاكيد الحذف',
                text: "لا يمكن التراجع بعد الحذف",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم احذف',
                cancelButtonText: 'تراجع',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(result) {
                if(result.value) {
                    Livewire.emit('deleteItem' , itemId)
                    swalInit.fire({
                        text: 'تم الحذف بنجاح',
                        icon: 'success',
                        toast: true,
                        showConfirmButton: false,
                        position: 'top-start' , 
                        timer: 1500
                    });
                }
            });
        })




    });
</script>
@endsection