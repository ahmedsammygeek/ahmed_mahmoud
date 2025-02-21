@extends('board.layout.master')

@section('page_title')
@lang('courses.show course details')
@endsection

@section('breadcrumb')
<a href="{{ route('board.courses.index') }}" class="breadcrumb-item"> @lang('courses.courses') </a>
<span class="breadcrumb-item active"> @lang('courses.show course details') </span>
@endsection

@section('page_content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('board.courses.index') }}" class="btn btn-primary mb-2 " style="float: left;">
            @lang('course.show all courses')
        </a>
    </div>
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
            <li class="nav-item">
                <a href="{{ route('board.courses.show', $course) }}" class="nav-link active"> تفاصيل   الكورس   </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('board.courses.units.index', $course) }}" class="nav-link "> الوحدات </a>
            </li>
            <li class="nav-item">
               <a href="{{ route('board.courses.students.index', $course) }}" class="nav-link"> الطلبه   <span style="margin-right:10px;" class='badge bg-success '> {{ $course->students()->count() }} </span> </a>
            </li>
            <li class="nav-item">
                {{-- <a href="{{ route('board.courses.reviews', $course) }}" class="nav-link"> التقييمات</a> --}}
            </li>
            <li class="nav-item">
                {{-- <a href="{{ route('board.courses.installments.index', $course) }}" class="nav-link">الاقساط </a> --}}
            </li>
        </ul>
    </div>
</div>
<!-- Main charts -->

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class='card-body'>
                <table class='table table-bordered table-responsive table-striped'>
                    <tbody>
                        <tr>
                            <th class='col-md-3' > @lang('courses.created at') </th>
                            <td class='col-md-9' > 
                                {{ $course->created_at }} <span class='text-muted'> {{ $course->created_at->diffForHumans() }} </span> 
                            </td>
                        </tr>

                        <tr>
                            <th class='col-md-3' >  @lang('courses.added by') </th>
                            <td class='col-md-9' > <a href="{{ route('board.admins.show', $course->user_id) }}">
                                {{ $course->user?->name }} </a> </td>
                            </tr>




                            <tr>
                                <th class='col-md-3' > @lang('courses.title') [@lang('courses.arabic')] </th>
                                <td class='col-md-9' > {{ $course->getTranslation('title', 'ar') }} </td>
                            </tr>

                            <tr>
                                <th class='col-md-3' > @lang('courses.title') [@lang('courses.english')] </th>
                                <td class='col-md-9' > {{ $course->getTranslation('title', 'en') }} </td>
                            </tr>


                            <tr>
                                <th class='col-md-3' > @lang('courses.content') [@lang('courses.arabic')] </th>
                                <td class='col-md-9' > {!! $course->getTranslation('content', 'ar') !!} </td>
                            </tr>

                            <tr>
                                <th class='col-md-3' > @lang('courses.content') [@lang('courses.english')] </th>
                                <td class='col-md-9' > {!! $course->getTranslation('content', 'en') !!} </td>
                            </tr>

                            <tr>
                                <th class='col-md-3' > @lang('courses.status') </th>
                                <td class='col-md-9' >
                                    @switch($course->is_active)
                                    @case(1)
                                    <span class="badge bg-primary"> @lang('courses.active') </span>
                                    @break

                                    @case(0)
                                    <span class="badge bg-danger"> @lang('courses.inacive')  </span>
                                    @break
                                    @endswitch
                                </td>
                            </tr>

                            <tr>
                                <th class='col-md-3' > @lang('courses.show in suggested courses') </th>
                                <td class='col-md-9' >
                                    @switch($course->show_in_home)
                                    @case(1)
                                    <span class="badge bg-primary"> @lang('courses.yes') </span>
                                    @break

                                    @case(0)
                                    <span class="badge bg-danger"> @lang('courses.no') </span>
                                    @break
                                    @endswitch
                                </td>
                            </tr>

                            <tr>
                                <th class='col-md-3' > @lang('courses.price') </th>
                                <td class='col-md-9' >
                                    {{ $course->price }} <span class="text-muted"> @lang('courses.le') </span>
                                </td>
                            </tr>


                            <tr>
                                <th class='col-md-3' > @lang('courses.educational system') </th>
                                <td class='col-md-9' >
                                 <ul>
                                     @foreach ($course->educationalSystems as $educationalSystem)
                                     <li> {{ $educationalSystem->educationalSystem?->name }} </li>
                                     @endforeach
                                 </ul>
                             </td>
                         </tr>


                         <tr>
                            <th class='col-md-3' > @lang('courses.teacher') </th>
                            <td class='col-md-9' >
                             {{ $course->teacher?->name }}
                         </td>
                     </tr>



                     <tr>
                        <th class='col-md-3' > @lang('courses.grade') </th>
                        <td class='col-md-9' >
                            {{ $course->grade?->name }}
                        </td>
                    </tr>


                    <tr>
                        <th class='col-md-3' > الصوره الكورس الحاليه </th>
                        <td class='col-md-9' >
                            <div class="col-sm-6 col-lg-3">
                                <div class="card">
                                    <div class="card-img-actions m-1">
                                        <a href="{{ Storage::url('courses/' . $course->image) }}"
                                            class="btn btn-outline-white btn-icon rounded-pill"
                                            data-bs-popup="lightbox" data-gallery="gallery1">
                                            <img src="{{ Storage::url('courses/' . $course->image) }}"
                                            class="avatar" width="120" height="120" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection


@section('scripts')
<script src="{{ asset('board_assets/js/vendor/media/glightbox.min.js') }}"></script>
<script src="{{ asset('board_assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('board_assets/demo/pages/gallery.js') }}"></script>
@endsection
