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

			@livewire('board.groups.add-new-group')

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