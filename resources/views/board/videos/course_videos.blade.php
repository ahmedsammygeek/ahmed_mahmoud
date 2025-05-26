@extends('board.layout.master')

@section('page_title' , 'عرض كافه الفديوهات' )

@section('breadcrumb')
<a href="{{ route('board.videos.index') }}" class="breadcrumb-item"> الفديوهات </a>

<span class="breadcrumb-item active"> عرض كافه الفديوهات  </span>
@endsection

@section('page_content')
@livewire('board.videos.list-all-lesson-videos' , ['unit' => $unit , 'lesson' => $lesson ]) 
@endsection

