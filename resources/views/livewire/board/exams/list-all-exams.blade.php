<div class="row">
    <div class="col-md-12">
        <a href='{{ route('board.exams.create') }}' class='btn btn-primary mb-2' style="float: left;">  <i class="icon-plus3 me-2"></i>  
            @lang('exams.add new exam')
        </a>
        <a class='btn btn-primary mb-2 me-2' data-bs-toggle="collapse" data-bs-target="#filters" aria-expanded="true"  style="float: left;">  
            <i class="icon-filter4 me-2"></i> 
        </a>
    </div>
    <div class="col-md-12 collapse" id='filters' wire:ignore.self >
        <div class="card card-body">

            <div class="d-sm-flex align-items-sm-start mt-2">

                <div class="dropdown ms-sm-3  mb-sm-0">
                    <input type="text" class='form-control' wire:model.live='search' >
                </div>
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='course_id' class="form-select">
                        <option value=""> @lang('students.all courses') </option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}"> {{ $course->title }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('exams.show all exams') </h5>
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
                            <th> @lang('exams.title') </th>
                            <th> @lang('exams.course') </th>
                            <th> @lang('exams.starts at') </th>
                            <th> @lang('exams.ends at') </th>
                            <th> @lang('exams.duration') </th>
                            <th> @lang('exams.options') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1
                        @endphp
                        @foreach ($exams as $exam)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $exam->title }} </td>
                            <td> {{ $exam->course?->title }} </td>
                            <td> {{ $exam->starts_at }} </td>
                            <td> {{ $exam->ends_at }} </td>
                            <td> {{ $exam->duration }} <span class='text-muted' > @lang('exams.minutes') </span> </td>
                            <td>
                                <a href='{{ route('board.exams.students.index' , $exam ) }}' class='btn btn-sm btn-primary ' title="@lang('exams.students')" >  <i class="icon-users4"></i>  </a>
                                <a href='{{ route('board.exams.show' , $exam ) }}' class='btn btn-sm btn-primary ' title="@lang('dashboard.view')" >  <i class="icon-eye "></i>  </a>

                                <a href='{{ route('board.exams.edit' , $exam ) }}' class='btn btn-sm btn-warning ' title="@lang('dashboard.edit')" >  <i class="icon-database-edit2 "></i>  </a>
                                <a wire:click="$dispatch('deleteConfirmation', '{{ $exam->id }}')" class='btn btn-sm btn-danger  delete_item' title="@lang('dashboard.delete')" >  <i class="icon-trash "></i>  </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
                <div class="pagination hstack gap-3">

                </div>

                {{ $exams->links() }}
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