<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Sidebar header -->
		<div class="sidebar-section">
			<div class="sidebar-section-body d-flex justify-content-center">
				<h5 class="sidebar-resize-hide flex-grow-1 my-auto"> @lang('dashboard.navigation') </h5>

				<div>
					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
						<i class="ph-arrows-left-right"></i>
					</button>

					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
						<i class="ph-x"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /sidebar header -->
		<!-- Main navigation -->
		<div class="sidebar-section">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item-header pt-0">
					<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
					<i class="ph-dots-three sidebar-resize-show"></i>
				</li>
				<li class="nav-item">
					<a href="{{ route('board.index') }}" class="nav-link active">
						<i class="ph-house"></i>
						<span>
							@lang('dashboard.home')
						</span>
					</a>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.slides.index') }}" class="nav-link">
						<i class="icon-images2"></i>
						<span> @lang('slides.slides') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.slides.create') }}" class="nav-link "> @lang('slides.add new slide') </a></li>
						<li class="nav-item"><a href="{{ route('board.slides.index') }}" class="nav-link"> @lang('slides.show all slides') </a></li>
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.courses.index') }}" class="nav-link">
						<i class="icon-graduation2  "></i>
						<span> @lang('courses.courses') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.courses.create') }}" class="nav-link "> @lang('courses.add new course') </a></li>
						<li class="nav-item"><a href="{{ route('board.courses.index') }}" class="nav-link"> @lang('courses.show all courses') </a></li>
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.students.index') }}" class="nav-link">
						<i class="icon-graduation2  "></i>
						<span> @lang('students.students') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.students.create') }}" class="nav-link "> @lang('students.add new student') </a></li>
						<li class="nav-item"><a href="{{ route('board.students.index') }}" class="nav-link"> @lang('students.show all students') </a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>