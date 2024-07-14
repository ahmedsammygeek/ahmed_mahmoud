@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.groups.index') }}" class="breadcrumb-item">  @lang('groups.groups') </a>
<span class="breadcrumb-item active"> @lang('groups.show group calendar') </span>
@endsection

@section('page_content')
<div class="card">
	<div class="card-header text-white bg-primary">
		<h5 class="mb-0"> {{ $group->name }} </h5>
	</div>

	<div class="card-body">
		<div class="fullcalendar-basic"></div>
	</div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('board_assets/js/vendor/ui/fullcalendar/main.min.js') }}"></script>
<script>
	$(document).ready(function() {
		 const events = {!! json_encode($times) !!} ;

		const calendarBasicViewElement = document.querySelector('.fullcalendar-basic');
		if(calendarBasicViewElement) {
			const calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay' ,
				},
				locale: 'ar' , 
				initialDate: @json(Carbon\Carbon::today()) ,
                navLinks: true, // can click day/week names to navigate views
                nowIndicator: true,
                weekNumberCalculation: 'ISO',
                editable: true,
                selectable: false,
                direction: document.dir == 'rtl' ? 'rtl' : 'ltr',
                dayMaxEvents: true, // allow "more" link when too many events
                events: events
            });

            // Init
			calendarBasicViewInit.render();

            // Resize calendar when sidebar toggler is clicked
			document.querySelectorAll('.sidebar-control').forEach(function(sidebarToggle) {
				sidebarToggle.addEventListener('click', function() {
					calendarBasicViewInit.updateSize();
				});
			});
		}
	});
</script>
@endpush