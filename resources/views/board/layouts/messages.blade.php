

@if (Session::has('success'))
<script>
	$(document).ready(function() {
		Noty.overrideDefaults({
			theme: 'limitless',
			layout: 'topRight',
			type: 'alert',
			timeout: 2500
		});

		new Noty({
			text: '{{ Session::get('success') }}',
			type: 'success'
		}).show();
	});
</script>
@endif





@if (Session::has('error'))
<script>
	$(document).ready(function() {
		Noty.overrideDefaults({
			theme: 'limitless',
			layout: 'topRight',
			type: 'alert',
			timeout: 2500
		});

		new Noty({
			text: '{{ Session::get('error') }}',
			type: 'error'
		}).show();
	});
</script>
@endif


@if (Session::has('warning'))
<script>
	$(document).ready(function() {
		Noty.overrideDefaults({
			theme: 'limitless',
			layout: 'topRight',
			type: 'alert',
			timeout: 2500
		});

		new Noty({
			text: '{{ Session::get('warning') }}',
			type: 'warning'
		}).show();
	});
</script>
@endif



