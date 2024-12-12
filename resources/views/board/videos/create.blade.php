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


{{-- @section('styles')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

<script type="text/javascript">
	$(document).ready(function() {


		FilePond.setOptions({
        server: {
            url: "{{ route('board.proccess_video_uploads') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ @csrf_token() }}",
            }
        }
    });

    // Create the FilePond instance

    FilePond.create(document.querySelector('input[name="video"]'));

	});
</script>
@endsection --}}