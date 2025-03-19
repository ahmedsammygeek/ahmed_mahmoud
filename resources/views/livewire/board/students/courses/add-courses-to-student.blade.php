<div>
 <div class="row">
    <div class="col-md-12">
        <button class="btn btn-success mb-2" wire:click.prevent='addMoreCoursesToThisStudents' style="float: left;">  
            <i class="icon-plus3 me-2"></i>  

        </button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"> @lang('courses.add new course') </h5>
            </div>
            <div class="card-body">
                <form class="" method="POST" action="{{ route('board.students.courses.store' , ['student' => $student] ) }}" enctype="multipart/form-data">

                    @csrf

                    @for ($i = 0; $i < $courses_count ; $i++)
                    @livewire('board.students.courses.add-course-to-student' , ['student' => $student] , key($i) )
                    @endfor

                    <div class="card-footer d-flex justify-content-end">

                        <button type="submit" class="btn btn-primary ms-3">
                            @lang('dashboard.add') 
                            <i  class="ph-paper-plane-tilt ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
