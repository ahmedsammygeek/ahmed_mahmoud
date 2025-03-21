<div class="row">
    <div class="col-md-12">
        <a href='{{ route('board.videos.create') }}' class='btn btn-primary mb-2' style="float: left;">  <i class="icon-plus3 me-2"></i>  
            @lang('videos.add new video')
        </a>
        <a class='btn btn-primary mb-2 me-2' data-bs-toggle="collapse" data-bs-target="#filters" aria-expanded="true"  style="float: left;">  
            <i class="icon-filter4 me-2"></i> 
        </a>
    </div>
    <div class="col-md-12 collapse" id='filters' wire:ignore.self >
        <div class="card card-body">

            <div class="d-sm-flex align-items-sm-start mt-2">
                {{-- <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='grade_id' class="form-select">
                        <option value=""> @lang('students.all grades') </option>
                        @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}"> {{ $grade->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='educational_system_id' class="form-select">
                        <option value=""> @lang('students.all educational systems') </option>
                        @foreach ($systems as $system)
                        <option value="{{ $system->id }}"> {{ $system->name }} </option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='teacher_id' class="form-select">
                        <option value=""> @lang('students.all teachers') </option>
                        @foreach ($this->teachers as $teacher)
                        <option value="{{ $teacher->id }}"> {{ $teacher->name }} </option>
                        @endforeach
                    </select>
                    {{ $teacher_id }}
                </div>
                <div class="dropdown ms-sm-4  mb-sm-0"  >
                    <select wire:model.change='course_id' class="form-select-lg form-select">
                        <option value=""> @lang('students.all courses') </option>
                        @foreach ($this->courses as $course)
                        <option value="{{ $course->id }}"> {{ $course->title }} </option>
                        @endforeach
                    </select>
                    {{ $course_id }}
                </div>

                <div class="dropdown ms-sm-4  mb-sm-0"  >
                    <select wire:model.change='unit_id' class="form-select-lg form-select ">
                        <option value=""> @lang('students.all units') </option>
                        @foreach ($this->units as $unit)
                        <option value="{{ $unit->id }}"> {{ $unit->title }} </option>
                        @endforeach
                    </select>
                    {{ $unit_id }}
                </div>
                <div class="dropdown ms-sm-4  mb-sm-0"  >
                    <select wire:model.change='lesson_id' class="form-select-lg form-select ">
                        <option value=""> @lang('students.all lessons') </option>
                        @foreach ($this->lessons as $lesson)
                        <option value="{{ $lesson->id }}"> {{ $lesson->title }} </option>
                        @endforeach
                    </select>
                    {{ $lesson_id }}
                </div>


                
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model.change='student_type' class="form-select">
                        <option value=""> @lang('students.all students') </option>
                        <option value="1"> @lang('students.only center students') </option>
                        <option value="2"> @lang('students.only online students') </option>
                    </select>
                </div>
{{-- 
               
                <div class="dropdown ms-sm-3  mb-sm-0">
                    <select wire:model='show_in_home' class="form-select">
                        <option value="">   جميع الكورسات داخل الصفحه الرئيسيه  </option>
                        <option value="1"> المعروض  </option>
                        <option value="0"> غير المعروض </option>

                    </select>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-sm-flex align-items-sm-center ">
                <h5 class="mb-0"> @lang('video.show all videos') </h5>
                <div class="ms-sm-auto my-sm-auto">
                    <select wire:model.live='rows' class="form-select ">
                        {{-- <option value="2">2 @lang('dashboard.rows') </option> --}}
                        <option value="15">15 @lang('dashboard.rows') </option>
                        <option value="30">30 @lang('dashboard.rows') </option>
                        <option value="50">50 @lang('dashboard.rows') </option>
                        <option value="70">70 @lang('dashboard.rows') </option>
                        <option value="100">100 @lang('dashboard.rows') </option>
                    </select>
                </div>
            </div>
            <div class='card-body' >
               <div class="d-sm-flex align-items-sm-start">
                <div class="form-control-feedback form-control-feedback-start flex-grow-1 mb-3 mb-sm-0">
                    <input type="text" wire:model.live.debounce.500ms='search' class="form-control" placeholder="البحث داخل الفديوهات">
                    <div class="form-control-feedback-icon">
                        <i class="ph-magnifying-glass"></i>
                    </div>
                </div>
            </div>
        </div>
        <div wire:loading> 
            <div class="card-overlay card-overlay-fadeout">
                <span class="ph-spinner spinner"></span>
                جارى ترتيب الدروس
            </div>
        </div>
        <table  class='table  table-responsive table-striped table-xs text-center '>
            <thead>
                <tr>
                    <th> # </th>
                    <th> @lang('videos.title') </th>
                    <th> @lang('videos.lesson') </th>
                    <th> @lang('videos.link') </th>
                    <th> @lang('videos.mintes') </th>
                    <th> @lang('videos.sorting') </th>
                    <th> @lang('videos.added_by') </th>
                    <th> @lang('videos.options') </th>
                </tr>
            </thead>
            <tbody wire:sortable="updateVideoOrder">
                @php
                $i =1
                @endphp
                @foreach ($videos as $video)
                <tr wire:sortable.item="{{ $video->id }}" wire:key="video-{{ $video->id }}">
                    <td> {{ $i++ }} </td>
                    <td> {{ $video->title }} </td>
                    <td> {{ $video->lesson?->title }} </td>
                    <td> <a target="_blank" href="{{ $video->lesson_video_link }}"> <i class='icon-youtube '>  </i> </a> </td>
                    <td> {{ $video->lesson_mins }} <span class="text-muted"> دقيقه </span> </td>
                    <td> {{ $video->sorting }} </td>
                    <td> {{ $video->user?->name }} </td>
                    <td>
                        <a class='btn btn-sm btn-info ' title="@lang('dashboard.view')" >  <i class="icon-grab "></i>  </a>
                        
                        <a href='{{ route('board.videos.show' , $video ) }}' class='btn btn-sm btn-primary ' title="@lang('dashboard.view')" >  <i class="icon-eye "></i>  </a>
                        <a href='{{ route('board.videos.edit' , $video ) }}' class='btn btn-sm btn-warning ' title="@lang('dashboard.edit')" >  <i class="icon-database-edit2 "></i>  </a>
                        <a wire:click="$dispatch('deleteConfirmation', '{{ $video->id }}')" class='btn btn-sm btn-danger  delete_item' title="@lang('dashboard.delete')" >  <i class="icon-trash "></i>  </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer d-sm-flex justify-content-sm-between flex-sm-wrap py-sm-2">
            <div class="pagination hstack gap-3">

            </div>

            {{ $videos->links() }}
        </div>
    </div>
</div>
</div>



@section('scripts')
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/extra_sweetalert.js') }}"></script>
{{-- <script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script> --}}
{{-- <script src="{{ asset('board_assets/assets/demo/pages/form_select2.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>


<script>
    $(function() {

  

        // $('.select2').select2();

        // document.addEventListener("livewire:initialized", () => {

            // alert('ff');
            // $(".select2").select2()
            // .on("select2:select", function () {
            //     const values = $(this).val();
            //     console.log(values);
            //     @this.set("course_id", values);
            // });
        // });


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