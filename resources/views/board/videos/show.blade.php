@extends('board.layout.master')

@section('page_title', 'عرض بيانات الفديو ')

@section('breadcrumb')
<a href="{{ route('board.videos.index') }}" class="breadcrumb-item"> الفديوهات </a>
<span class="breadcrumb-item active"> عرض بيانات الفديو  </span>
@endsection

@section('page_content')

<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"> عرض بيانات الفديو </h5>
            </div>

            <div class='card-body'>
                <table class='table table-responsive  '>
                    <tbody>

                        <tr class='row'>
                            <th class='col-md-2'> تاريخ الاضافه </th>
                        <td class='col-md-10'> {{ $video->created_at }}
                                <span class='text-muted'>
                                    {{ $video->created_at?->diffForHumans() }}
                                </span>
                            </td>
                        </tr>

                        <tr class='row'>
                            <th class='col-md-2'> تم الاضافه بواستطه </th>
                            <td class='col-md-10'> 
                                {{ $video->user?->name }}  </td>
                            </tr>

                            <tr class='row'>
                                <th class='col-md-2'> الدرس </th>
                                <td class='col-md-10'>
                                     {{ $video->lesson?->title }}
                                </td>
                            </tr>

                            <tr class='row'>
                                <th class='col-md-2'> عنوان الفديو بالعربيه </th>
                                <td class='col-md-10'> {{ $video->getTranslation('title' , 'ar' ) }}  </td>
                            </tr>

                            <tr class='row'>
                                <th class='col-md-2'> عنوان الفديو بالعربيه </th>
                                <td class='col-md-10'> {{ $video->getTranslation('title' , 'en' ) }}  </td>
                            </tr>

                             <tr class='row'>
                                <th class='col-md-2'> محتوى الفديو بالعربيه </th>
                                <td class='col-md-10'> {{ $video->getTranslation('content' , 'ar' ) }}  </td>
                            </tr>

                            <tr class='row'>
                                <th class='col-md-2'> محتوى الفديو بالعربيه </th>
                                <td class='col-md-10'> {{ $video->getTranslation('content' , 'en' ) }}  </td>
                            </tr>

                            <tr class='row'>
                                <th class='col-md-2'> رابط الفديو </th>
                                <td class='col-md-10'> 
                                    <a target="_blank" href="{{ $video->lesson_video_link }}"> <i class='icon-youtube '>  </i> </a>
                                </td>
                            </tr>


                            <tr class='row'>
                                <th class='col-md-2'> السماح بالعرض </th>
                                <td class='col-md-10'>
                                    @switch($video->is_active )
                                    @case(1)
                                    <span class="badge bg-success"> نعم </span>
                                    @break
                                    @case(0)
                                    <span class="badge bg-danger"> لا</span>
                                    @break
                                    @endswitch
                                </td>
                            </tr>

                            <tr class='row'>
                                <th class='col-md-2'> هل الفديو مجانى </th>
                                <td class='col-md-10'>
                                    @switch($video->is_free )
                                    @case(1)
                                    <span class="badge bg-success"> نعم </span>
                                    @break
                                    @case(0)
                                    <span class="badge bg-danger"> لا </span>
                                    @break
                                    @endswitch
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
