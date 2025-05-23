<div class='row'>
    <div class="col-md-12">
        <a class='btn btn-primary ' href='{{ route('board.students.library.create' , $student ) }}' >  <i class="icon-plus3 me-2"> </i>   إضافه كورس جديد </a>
    </div>

    <div class="col-md-12 mt-1">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> عرض كافه كورسات المكتبه </h5>
                <div class="ms-sm-auto my-sm-auto">
                    <select wire:model.live='rows' class="form-select ">
                        <option value="2">2 @lang('dashboard.rows') </option>
                        <option value="15">15 @lang('dashboard.rows') </option>
                        <option value="30">30 @lang('dashboard.rows') </option>
                        <option value="50">50 @lang('dashboard.rows') </option>
                        <option value="70">70 @lang('dashboard.rows') </option>
                        <option value="100">100 @lang('dashboard.rows') </option>
                    </select>
                </div>
            </div>
            <table  class='table  table-responsive table-striped table-xs text-center '>
                <thead>
                    <tr>
                        <th> @lang('library.course') </th>
                        <th> @lang('library.force watermark') </th>
                        <th> @lang('library.allow downloads') </th>
                        <th> @lang('library.allow') </th>
                        <th> @lang('library.options') </th>
                    </tr>
                </thead>
                <tbody class='text-center center-block' >

                    @foreach ($student_library_courses as $student_library_course)
                    <tr>
                        <td>
                            {{ $student_library_course?->course?->title }}
                        </td>
                        <td>
                            <div class="form-check form-switch  mb-2 center-block ">
                                <input type="checkbox" wire:click='manipluateWaterMarkOption({{ $student_library_course->id }})' class="form-check-input"  {{ $student_library_course->force_water_mark == 1 ? 'checked' : '' }} >
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-switch  mb-2 center-block ">
                                <input type="checkbox" wire:click='manipluateDownloadOption({{ $student_library_course->id }})' class="form-check-input allow_download"  {{ $student_library_course->allow_download == 1 ? 'checked' : '' }} >
                            </div>
                        </td>

                        <td>
                           
                            <div class="form-check form-switch  mb-2 center-block ">
                                <input type="checkbox" wire:click='manipluateAvailabilityOption({{ $student_library_course->id }})'  class="form-check-input disallow" {{ $student_library_course->is_allowed == 1 ? 'checked' : '' }}>
                            </div>
                            
                        </td>

                        <td>
                            {{-- <a class='btn btn-sm btn-primary ' title='الدروس' href="{{ route('board.students.courses.units.index' , [ 'student' => $student , 'course' => $student_library_course->course_id ] ) }}"   >  <i class="icon-archive "></i>  </a> --}}
                            <a class='btn btn-sm btn-primary ' title='الملفات' href="{{ route('board.students.library.files.index' , [ 'student' => $student , 'course' => $student_library_course->course_id ] ) }}"   >  <i class="icon-books "></i>  </a>
                            <a class='btn btn-sm btn-primary  ' title='مشاهده' href="{{ route('board.students.library.show' , ['student' => $student_library_course->student_id , 'library' => $student_library_course->course_id ] ) }}" >  <i class="icon-eye "></i>  </a>                       
                            <a wire:click="$dispatch('deleteConfirmation', '{{ $student_library_course->id }}')" class='btn btn-sm btn-danger  delete_item' title="@lang('dashboard.delete')" >  <i class="icon-trash "></i>  </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">

                {{-- {{ $student_courses->links() }} --}}
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
<script>
    $(document).ready(function() {


        Livewire.on('changed' , () => {
            $(document).find('#not_allow_message_modal').modal('hide');
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
@endpush