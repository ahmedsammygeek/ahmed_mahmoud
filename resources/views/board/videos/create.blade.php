@extends('board.layout.master')
@section('page_title' , ' إضافه فديو جديد' )

@section('breadcrumb')
<a href="{{ route('board.videos.index') }}" class="breadcrumb-item"> الفديوهات </a>


<span class="breadcrumb-item active"> إضافه فديو جديد </span>
@endsection

@section('page_content')
<div class="row">


	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> إضافه فديو جديد  </h5>
			</div>


            @livewire('board.videos.add-new-video')

        </div>
    </div>
</div>

@endsection


