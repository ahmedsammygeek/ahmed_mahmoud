<div class="row">
    <div class="col-md-12">
        <a href='{{ route('board.brands.create') }}' class='btn btn-primary mb-2' style="float: left;">  <i class="icon-plus3  me-2"></i>  إضافه علامه تجاريه جديده </a>

        <a  class='btn btn-primary mb-2 ' data-bs-toggle="collapse" data-bs-target="#filters" style="float: left; margin-left: 4px;">
            <i  class='icon-filter3 ' >  </i>
        </a>
    </div>
    <div class="col-md-12 collapse" id="filters" wire:ignore.self>
        <div class="card">
            <div class="card-body d-sm-flex">
                <div class="form-control-feedback form-control-feedback-start flex-grow-1 mb-3 mb-sm-0">
                    <input wire:model='search' type="text" class="form-control"  placeholder="البحث داخل العلامات التجاريه">
                    <div class="form-control-feedback-icon">
                        <i class="ph-magnifying-glass"></i>
                    </div>
                </div>

                <div class="ms-sm-3" wire:ignore>
                    <select wire:model='item_id' class="form-select select wmin-sm-200 mb-3 mb-sm-0">
                        <option value="all"> جميع الاصناف </option>
                        @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="ms-sm-3">
                    <select wire:model='is_active' class="form-select wmin-sm-200 mb-3 mb-sm-0">
                        <option value="all"> جميع العلامات </option>
                        <option value="1">فعال</option>
                        <option value="0">غير فعال</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> عرض كافه العامات التجاريه  </h5>
                <div class="ms-sm-auto my-sm-auto">
                    <select wire:model='rows' class="form-select wmin-200">
                        <option value="15">15 عدد صفوف العرض </option>
                        <option value="30">30 عدد صفوف العرض </option>
                        <option value="50">50 عدد صفوف العرض </option>
                        <option value="70">70 عدد صفوف العرض </option>
                        <option value="100">100 عدد صفوف العرض </option>
                    </select>
                </div>
            </div>
            <div class='card-body' >
                <table  class='table table-bordered table-responsive table-striped'>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> اسم العلامه بالعربيه </th>
                            <th> اسم العلامه بالانجليزيه </th>
                            <th> الصنف </th>
                            <th> حاله العلامه </th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1
                        @endphp
                        @foreach ($brands as $brand)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $brand->getTranslation('name' , 'ar') }} </td>
                            <td> {{ $brand->getTranslation('name' , 'en') }} </td>
                            <td> <a href="{{ route('board.items.show' , $brand->product_id ) }}"> {{ $brand->item?->name }} </a> </td>
                            <td>
                                @if ($brand->is_active)
                                <span class='badge bg-success' > فعال</span>
                                @else
                                <span class='badge bg-danger' > غير فعال </span>
                                @endif
                            </td>
                            <td>
                                <a href='{{ route('board.brands.show' , $brand ) }}' class='btn btn-sm btn-primary mb-2' title='مشاهده' >  <i class="icon-eye "></i>  </a>
                                <a href='{{ route('board.brands.edit' , $brand ) }}' class='btn btn-sm btn-warning mb-2' title='تعديل' >  <i class="icon-database-edit2 "></i>  </a>
                                <a wire:click="$emit('deleteConfirmation', '{{ $brand->id }}')" class='btn btn-sm btn-danger mb-2 delete_item' title='حذف' >  <i class="icon-trash "></i>  </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
                <div class="pagination hstack gap-3">

                </div>

                {{ $brands->links() }}
            </div>
        </div>
    </div>
</div>



@section('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script>

<script>
    $(function() {
        $('.select').select2();


        $('.select').on('change', function (e) {
            var data = $('.select').select2("val");
            @this.set('item_id', data);
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