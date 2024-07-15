@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.dashboard_notifications.index') }}" class="breadcrumb-item">  @lang('dashboard_notification.dashboard_notification') </a>
<span class="breadcrumb-item active"> @lang('dashboard_notification.show notification details') </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0"> @lang('dashboard_notifications.show notification details') </h5>
			</div>

			<div class='card-body' >
				<table  class='table table-responsive '>
					<tbody>
						<tr class='row'>
							<th class='col-md-2' > تاريخ الاضافه </th>
							<td class='col-md-10' > {{ $dashboard_notification->created_at }} <span class='text-muted' > {{ $dashboard_notification->created_at->diffForHumans() }} </span> </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تم الاضافه بواستطه </th>
							<td class='col-md-10' >   {{ $dashboard_notification->user?->name }}  </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم القسم بالعربيه </th>
							<td class='col-md-10' > {{ $dashboard_notification->getTranslation('title' , 'ar') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > اسم القسم بالانجليزيه </th>
							<td class='col-md-10' > {{ $dashboard_notification->getTranslation('title' , 'en') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تفاصيل القسم بالعربيه </th>
							<td class='col-md-10' > {{ $dashboard_notification->getTranslation('content' , 'ar') }} </td>
						</tr>

						<tr class='row' >
							<th class='col-md-2' > تفاصيل القسم بالانجليزيه </th>
							<td class='col-md-10' > {{ $dashboard_notification->getTranslation('content' , 'en') }} </td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection