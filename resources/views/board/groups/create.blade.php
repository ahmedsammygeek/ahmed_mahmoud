@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.groups.index') }}" class="breadcrumb-item"> @lang('groups.groups') </a>
<span class="breadcrumb-item active">  @lang('groups.add new group')  </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0">  @lang('groups.add new group')  </h5>
			</div>

			<form class="" method="POST" action="{{ route('board.groups.store') }}" enctype="multipart/form-data" >
				<div class="card-body">
					@csrf
					@livewire('board.groups.add-new-group')
				</div>

				<div class="card-footer d-flex justify-content-end">
					<a  href='{{ route('board.groups.index') }}' class="btn btn-light" id="reset"> @lang('groups.cancel') </a>
					<button type="submit" class="btn btn-primary ms-3"> @lang('groups.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')
	<script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script>
	<script>
		$(function() {
			 // $('.select').select2();
		});
	</script>
@endsection