<div class="row">
    <div class="col-md-12">
        <a href='{{ route('board.admins.create') }}' class='btn btn-primary mb-2' style="float: left;">  <i class="icon-user-plus me-2"></i>  إضافه مشرف جديد </a>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> عرض كافه المشرفين  </h5>
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
                            <th> الاسم </th>
                            <th> البريد الاكتورنى </th>
                            <th> تاريخ الاضافه </th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1
                        @endphp
                        @foreach ($admins as $admin)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $admin->name }} </td>
                            <td> {{ $admin->email }} </td>
                            <td> {{ $admin->created_at }} <span class="text-muted"> {{ $admin->created_at->diffForHumans() }} </span> </td>
                            <td>
                                <a href='{{ route('board.admins.show' , $admin ) }}' class='btn btn-sm btn-primary mb-2' title='مشاهده' >  <i class="icon-eye "></i>  </a>
                                <a href='{{ route('board.admins.edit' , $admin ) }}' class='btn btn-sm btn-warning mb-2' title='تعديل' >  <i class="icon-database-edit2 "></i>  </a>
                                <a wire:click="$emit('deleteConfirmation', '{{ $admin->id }}')" class='btn btn-sm btn-danger mb-2 delete_item' title='حذف' >  <i class="icon-trash "></i>  </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
                <div class="pagination hstack gap-3">

                </div>

                {{ $admins->links() }}
            </div>
        </div>
    </div>
</div>



@section('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
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
                cancelButtonText: 'الغاء',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(result) {
                Livewire.emit('deleteItem' , itemId)
                if(result.value) {
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