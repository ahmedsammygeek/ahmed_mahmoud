<div class="card">
    <div class='card-body'>
        <table class='table table-bordered table-responsive table-striped'>
            <thead>
                <tr>
                    <th> # </th>
                    <th> @lang('lessons.title') </th>
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