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
                            <a class='btn btn-sm btn-primary ' title='الدروس' href="{{ route('board.students.courses.units.index' , [ 'student' => $student , 'course' => $student_library_course->course_id ] ) }}"   >  <i class="icon-archive "></i>  </a>
                            <a class='btn btn-sm btn-primary ' title='الدروس' href="{{ route('board.students.courses.lessons.index' , [ 'student' => $student , 'course' => $student_library_course->course_id ] ) }}"   >  <i class="icon-video-camera2"></i>  </a>
                            <a class='btn btn-sm btn-primary  ' title='مشاهده' href="{{ route('board.students.courses.show' , ['student' => $student_library_course->student_id , 'course' => $student_library_course->course_id ] ) }}" >  <i class="icon-eye "></i>  </a>
                            <a class='btn btn-sm btn-warning  ' title='تعديل' href="{{ route('board.students.courses.edit' , ['student' => $student_library_course->student_id , 'course' => $student_library_course->course_id ] ) }}" >  <i class="icon-database-edit2 "></i>  </a>
                            <a data-item_id='{{ $student_library_course->id }}' class='btn btn-xs btn-danger delete_item' title='حذف' >  <i class="icon-trash "></i>  </a>
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

        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });


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


        $(document).on('click', 'a.delete_item', function(event) {
            event.preventDefault();
            var item_id = $(this).attr('data-item_id');
            swalInit.fire({
                title: "@lang('dashboard.delete confirmation')",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "@lang('dashboard.yes change')",
                cancelButtonText: "@lang('dashboard.cancel')",
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(result) {
                if(result.value) {
                    Livewire.dispatch('deleteStudentCourse' , {item_id} );
                }
            });        
        });


    });
</script>
@endpush