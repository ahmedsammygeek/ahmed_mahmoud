@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.announcements.index') }}" class="breadcrumb-item"> @lang('announcements.announcements') </a>
<span class="breadcrumb-item active">  @lang('announcements.add new announcement')  </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0">  @lang('exams.add new announcement')  </h5>
			</div>

			@livewire('board.announcements.add-new-announcement')

		</div>
	</div>
</div>

@endsection

@section('scripts')
	<script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('board_assets/js/vendor/ui/moment/moment.min.js') }}"></script>
	<script src="{{ asset('board_assets/js/vendor/pickers/daterangepicker.js') }}"></script>
	<script src="{{ asset('board_assets/js/vendor/pickers/datepicker.min.js') }}"></script>
	<script src="{{ asset('board_assets/demo/pages/picker_date.js') }}"></script>
	<script src="{{ asset('board_assets/js/vendor/forms/inputs/dual_listbox.min.js') }}"></script>
	<script src="{{ asset('board_assets/demo/pages/form_dual_listboxes.js') }}"></script>
	<script>
		$(function() {
			 // $('.select').select2();
		});
	</script>
@endsection