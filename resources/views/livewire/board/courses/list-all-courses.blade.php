<div>
    <div class="row">
        <div class="col-md-12">
            <a href='{{ route('board.courses.create') }}' class='btn btn-primary mb-2' style="float: left;">  <i class="icon-plus3 me-2"></i>  
                @lang('courses.add new course')
            </a>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-5">
            <input type="text" class='form-control' placeholder="search by course namae...." wire:model.live='search'>
        </div>
        <div class="col-md-3" >
            <select  wire:model.live='teacher_id'  class='select form-control'>
                <option value="">جميع المدرسين</option>
                @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}"> {{ $teacher->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" >
            <select wire:model.live="rows" class="form-select ">
                <option value="2"> 2 صف </option>
                <option value="15">15 صف </option>
                <option value="30">30 صف </option>
                <option value="50">50 صف </option>
                <option value="70">70 صف </option>
                <option value="100">100 صف </option>
            </select>
        </div>
    </div>

    <div class="row">

        @foreach ($courses as $course)
        <div class="col-lg-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{ Storage::url('courses/'.$course->image) }}" alt="">

                <div class="card-body">
                    <h5 class="card-title"> 
                        <a href="{{ route('board.courses.show' , $course ) }}" class='text-black' >
                            {{ $course->title }}
                        </a>
                    </h5>
                </div>

                <div class="card-footer">
                    @can('show course details')
                    <a href='{{ route('board.courses.show' , $course ) }}' class='btn btn-sm btn-primary ' title='مشاهده' >  <i class="icon-eye "></i>  </a>
                    @endcan
                    @can('edit course details')
                    <a href='{{ route('board.courses.edit' , $course ) }}' class='btn btn-sm btn-warning ' title='تعديل' >  <i class="icon-database-edit2 "></i>  </a>
                    @endcan
                    @can('delete course')
                    <a wire:click="$dispatch('deleteConfirmation', '{{ $course->id }}')" class='btn btn-sm btn-danger  delete_item' title='حذف' >  <i class="icon-trash" ></i>  </a>
                    @endcan
                    <a href="{{ route('board.courses.fix' , $course ) }}" class='btn btn-success btn-sm'> <i class="icon-reading ">  </i > </a>

                    @can('remove students from courses')
                                          @livewire('board.courses.remove-students-from-course' , ['course' => $course] , key($course->id) )

                    @endcan
                </div>
            </div>
        </div>
        @endforeach


        <div class="col-md-12 card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
            <div class="pagination hstack gap-3">
                {{ $courses->links() }}
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