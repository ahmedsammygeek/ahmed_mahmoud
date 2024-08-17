<div class="row">
    <div class="col-md-12">
        @livewire('board.students.add-new-course-to-student' , ['student' => $student ] )
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('courses.show all student courses') </h5>
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
            <div class='card-body' >
                <table  class='table  table-responsive table-striped table-xs text-center '>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('students.course') </th>
                            <th> @lang('students.group') </th>
                            <th> @lang('students.force headphons') </th>
                            <th> @lang('students.show phone on viedo') </th>
                            <th> @lang('students.speak user phone') </th>
                            <th> @lang('students.allow') </th>
                            <th> @lang('students.options') </th>
                        </tr>
                    </thead>
                    <tbody class='text-center center-block' >
                        @php
                        $i =1
                        @endphp
                        @foreach ($student_courses as $student_course)
                        <tr>
                            <td> {{ $i++ }} </td>
                            
                            <td>
                                {{ $student_course?->course?->title }}
                            </td>
                            <td>
                                {{ $student_course?->group?->name }}
                            </td>

                            <td class='center-block' >
                                @if ($student_course->force_headphones)
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" wire:click='un_force_headphonse({{ $student_course->id }})' class="form-check-input un_force_headphonse" checked>
                                </div>
                                @else
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" wire:click='force_headphone({{  $student_course->id }})' class="form-check-input" >
                                </div>
                                <span> {{ $student_course->not_allow_message }} </span>
                                @endif
                            </td>

                            <td class='center-block' >
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" wire:click='show_phone_on_viedo({{ $student_course->id }})' class="form-check-input un_force_headphonse"  {{ $student_course->show_phone_on_viedo == 1 ? 'checked' : '' }} >
                                </div>
                            </td>


                            <td class='center-block' >
                               <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" wire:click='speak_user_phone({{ $student_course->id }})' class="form-check-input un_force_headphonse"  {{ $student_course->speak_user_phone == 1 ? 'checked' : '' }} >
                                </div>
                            </td>



                            <td>
                                @if ($student_course->allow)
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" data-course_id='{{ $student_course->id }}' class="form-check-input disallow" checked>
                                </div>
                                @else
                                <div class="form-check form-switch  mb-2 center-block ">
                                    <input type="checkbox" data-course_id='{{ $student_course->id }}' class="form-check-input allow" >
                                </div>
                                <span> {{ $student_course->not_allow_message }} </span>
                                @endif
                            </td>
                            <td>
                                <a class='btn btn-sm btn-primary' title='الدروس' href="{{ route('board.students.courses.lessons.index' , [ 'student' => $student , 'course' => $student_course->course_id ] ) }}"   >  <i class="icon-video-camera2"></i>  </a>
                                <a class='btn btn-sm btn-primary ' title='مشاهده' href="{{ route('board.students.courses.show' , ['student' => $student_course->student_id , 'course' => $student_course->course_id ] ) }}" >  <i class="icon-eye "></i>  </a>
                                <a class='btn btn-sm btn-warning ' title='تعديل' href="{{ route('board.students.courses.edit' , ['student' => $student_course->student_id , 'course' => $student_course->course_id ] ) }}" >  <i class="icon-database-edit2 "></i>  </a>
                                <a data-item_id='{{ $student_course->id }}' class='btn btn-sm btn-danger  delete_item' title='حذف' >  <i class="icon-trash "></i>  </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">

                {{ $student_courses->links() }}
            </div>
        </div>
    </div>
    <div id="not_allow_message_modal" wire:ignore.self class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('courses.disallow reason') </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit="disallow" class="form-horizontal">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-form-label col-sm-3"> @lang('courses.reason') </label>
                            <div class="col-sm-9">
                                <input type="text" wire:model.live='not_allow_message' class="form-control @error('not_allow_message') is-invalid @enderror ">
                                @error('not_allow_message')
                                <p class="is-invalid"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal"> @lang('dashboard.cancel') </button>
                        <button type="submit" class="btn btn-primary"> @lang('dashboard.edit') </button>
                    </div>
                </form>
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
        Livewire.on('deleted' , () => {

            swalInit.fire({
                text: "@lang('dashboard.deleted successfully')" ,
                icon: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-start' , 
                timer: 1500
            });
        });



        $(document).on('click', 'input.disallow', function(event) {
            event.preventDefault();
            var course_id = $(this).attr('data-course_id');

            swalInit.fire({
                title: "@lang('dashboard.change confirmation')",
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
                    @this.set('student_course_id', course_id, true)
                    $(document).find('#not_allow_message_modal').find('input[name="student_course_id"]').val(course_id);
                    $(document).find('#not_allow_message_modal').modal('show');
                }
            });

        });


        $(document).on('click', 'input.allow', function(event) {
            event.preventDefault();
            var course_id = $(this).attr('data-course_id');
            swalInit.fire({
                title: "@lang('dashboard.change confirmation')",
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
                    Livewire.dispatch('allowStudentToWatchCourse' , {course_id} );
                }
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