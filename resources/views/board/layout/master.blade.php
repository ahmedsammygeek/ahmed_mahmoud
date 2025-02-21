<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title> @lang('dashboard.home') | @yield('page_title') </title>

	<!-- Global stylesheets -->
	<link href="{{ asset('board_assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('board_assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{ asset('board_assets/icons/icomoon/styles.min.css') }}">
	<script src="{{ asset('board_assets/js/vendor/notifications/noty.min.js') }}"></script>
	@livewireStyles
	@yield('styles')
	@stack('styles')

	@if (LaravelLocalization::getCurrentLocale() == 'ar')
	<link href="{{ asset('assets/css/rtl/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
	
	<style>
		a , h1 , h2 , h3 , ul , li , li > a , h4 , h5 , h6 , span , input , table , thead , tbody , th , td , tr  , button , div {
			font-family: 'Cairo', sans-serif !important;
			font-weight:bold !important;
		}
	</style>
	@else
	<link href="{{ asset('assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
	@endif

	<style>
		@media print {

			.printarea { visibility: visible; }
			.noprintarea { visibility: hidden; }
		}

	</style>


	<script src="{{ asset('board_assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('board_assets/js/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/app.js') }}"></script>
	<script src="{{ asset('board_assets/demo/pages/dashboard.js') }}"></script>
</head>

<body>

	@include('board.layout.header')

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		@include('board.layout.sidebar')
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Page header -->
				<div class="page-header page-header-light shadow noprintarea ">
					<div class="page-header-content d-lg-flex">
						<div class="d-flex">
							<h4 class="page-title mb-0">
								تطبيق تعليم - <span class="fw-normal"> لوحه التحكم  </span>
							</h4>

							<a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a>
						</div>


					</div>

					<div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('board.index') }}" class="breadcrumb-item"><i class="ph-house"></i></a>
								<a href="{{ route('board.index') }}" class="breadcrumb-item"> @lang('dashboard.dashboard') </a>
								@yield('breadcrumb')
							</div>

							<a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a>
						</div>


					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					@yield('page_content')

				</div>
				<!-- /content area -->


				<!-- Footer -->
				@include('board.layout.footer')
				<!-- /footer -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


	<!-- Notifications -->
	<div class="offcanvas offcanvas-end" tabindex="-1" id="notifications">
		<div class="offcanvas-header py-0">
			<h5 class="offcanvas-title py-3">Activity</h5>
			<button type="button" class="btn btn-light btn-sm btn-icon border-transparent rounded-pill" data-bs-dismiss="offcanvas">
				<i class="ph-x"></i>
			</button>
		</div>


	</div>
	<!-- /notifications -->


	@livewireScripts
	@yield('scripts')
	@stack('scripts')
	@include('board.layout.messages')
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<x-livewire-alert::scripts />
</body>
</html>