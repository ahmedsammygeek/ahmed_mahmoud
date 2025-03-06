<div class='row'>

    <div class="col-lg-12">
        @if ($selected_unit_id)
        @if (!$has_all_lessons_videos)
        <div class="card card-body justify-content-end text-center" >
            <div>
                <i class="ph-x ph-2x text-danger border border-width-3 border-danger rounded-pill p-2 mb-3"></i>
                <h5 class="card-title"> تنبيه </h5>
                <p class="mb-3"> يوجد بعض الفديوهات التى تم اضافتها حديثا و لم يتم اضافتها لهذا الطالب </p>
                <a wire:click='fixStudentVideos' class="btn btn-primary"> اضف الدروس المتبقيه  للطالب </a>
            </div>
        </div>
        @endif
        @endif
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class='card-body'>
                <div class="form-group mt-2 mb-2">
                    <select wire:model.live='selected_unit_id' class="form-select form-control" id="">
                        <option value=""> جميع الاقسام </option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}"> {{ $unit->title }} -- {{ in_array($unit->id , $student_course_units ) ? 'مشترك بها' : 'غير مشترك بها' }} -- {{ $unit->id }} </option>
                        @endforeach
                    </select>
                </div>
                <table class='table table-bordered table-responsive table-striped'>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('lessons.lesson title') </th>
                            <th> @lang('lessons.video title') </th>
                            <th> @lang('lessons.added by') </th>
                            <th> @lang('lessons.created at') </th>
                            <th> @lang('lessons.allowed') </th>
                            <th> @lang('lessons.total_views_till_now') </th>
                            <th> @lang('lessons.allowed_views') </th>
                            <th> @lang('lessons.remains_views') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student_lessons as $student_lesson)
                        @livewire('board.students.courses.list-course-lesson' , ['lesson' => $student_lesson , 'index' => $loop->index  ] , key($student_lesson->id)  )
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    


</div>