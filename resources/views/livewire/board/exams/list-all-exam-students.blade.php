<div class="row">


    <div class="col-md-12">
        <div class="card ">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('exams.show all exam students ') : {{ $exam->title }} </h5>
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
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <input type="text" class='form-control' wire:model.live='search' placeholder="@lang('dashboard.search sutdents')" >
                </div>

                <table  class='table  table-responsive table-striped table-xs text-center '>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('exams.student') </th>
                            <th> @lang('exams.started at') </th>
                            <th> @lang('exams.ended at') </th>
                            <th> @lang('exams.total degree') </th>
                            <th> @lang('exams.is finished') </th>
                            <th> @lang('exams.is marked') </th>
                            <th> @lang('exams.options') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1
                        @endphp
                        @foreach ($exam_students as $exam_student)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $exam_student->student?->name }} </td>
                            <td> {{ $exam_student->started_at }} </td>
                            <td> {{ $exam_student->ended_at }} </td>
                            <td> {{ $exam_student->total_degree }} </td>
                            <td> 
                                @switch($exam_student->is_finished)
                                @case(0)
                                <span class='badge bg-danger' > @lang('dashboard.no') </span>
                                @break
                                @case(1)
                                <span class='badge bg-success' > @lang('dashboard.yes') </span>
                                @break
                                @endswitch
                            </td>
                             <td> 
                                @switch($exam_student->is_marked)
                                @case(0)
                                <span class='badge bg-danger' > @lang('dashboard.no') </span>
                                @break
                                @case(1)
                                <span class='badge bg-success' > @lang('dashboard.yes') </span>
                                @break
                                @endswitch
                            </td>
                            <td>

                                <a href='{{ route('board.exam_students.show' , $exam_student->id ) }}' class='btn btn-sm btn-primary ' title="@lang('dashboard.view')" >  <i class="icon-eye "></i>  </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
                <div class="pagination hstack gap-3">

                </div>

                {{ $exam_students->links() }}
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