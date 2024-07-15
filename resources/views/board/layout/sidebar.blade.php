@php
$groups = $home = $students = $dashboard_notifications = $questions = $exams = $users = $courses = $slides = '';



switch (request()->segment(3)) {
	case 'groups':
	$groups = 'active';
	break;
	case 'questions':
	$questions = 'active';
	break;
	case 'exams':
	$exams = 'active';
	break;
	case 'students':
	$students = 'active';
	break;
	case 'users':
	$users = 'active';
	break;
	case 'courses':
	$courses = 'active';
	break;
	case 'dashboard_notifications':
	$dashboard_notifications = 'active';
	break;
	case 'slides':
	$slides = 'active';
	break;
	default:
	$home = 'active';
	break;
}
@endphp

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
					<a href="{{ route('board.index') }}" class="nav-link {{ $home }}">
						<i class="ph-house"></i>
						<span>
							@lang('dashboard.home')
						</span>
					</a>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.slides.index') }}" class="nav-link {{ $slides }}">
						<i class="icon-images2"></i>
						<span> @lang('slides.slides') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.slides.create') }}" class="nav-link "> @lang('slides.add new slide') </a></li>
						<li class="nav-item"><a href="{{ route('board.slides.index') }}" class="nav-link"> @lang('slides.show all slides') </a></li>
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.courses.index') }}" class="nav-link {{ $courses }}">
						<i class="icon-graduation2  "></i>
						<span> @lang('courses.courses') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.courses.create') }}" class="nav-link "> @lang('courses.add new course') </a></li>
						<li class="nav-item"><a href="{{ route('board.courses.index') }}" class="nav-link"> @lang('courses.show all courses') </a></li>
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.students.index') }}" class="nav-link {{ $students }}">
						<i class="icon-users4"></i>
						<span> @lang('students.students') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.students.create') }}" class="nav-link "> @lang('students.add new student') </a></li>
						<li class="nav-item"><a href="{{ route('board.students.index') }}" class="nav-link"> @lang('students.show all students') </a></li>
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.groups.index') }}" class="nav-link {{ $groups }} ">
						<i class="icon-make-group "></i>
						<span> @lang('groups.groups') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.groups.create') }}" class="nav-link "> @lang('groups.add new gourp') </a></li>
						<li class="nav-item"><a href="{{ route('board.groups.index') }}" class="nav-link"> @lang('groups.show all groups') </a></li>
					</ul>
				</li>


				<li class="nav-item nav-item-submenu">
					<a  href="{{ route('board.questions.index') }}"  class="nav-link {{ $questions }} "  >
						<i class="icon-question7 "></i>
						<span> @lang('questions.questions') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.questions.create') }}" class="nav-link"> @lang('questions.add new question') </a></li>
						<li class="nav-item"><a href="{{ route('board.questions.index') }}" class="nav-link"> @lang('questions.show all questions') </a></li>
					</ul>
				</li>



				<li class="nav-item nav-item-submenu">
					<a  class="nav-link  {{ $exams }}">
						<i class="icon-compose "></i>
						<span> @lang('exams.exams') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.exams.create') }}" class="nav-link "> @lang('exams.add new exams') </a></li>
						<li class="nav-item"><a href="{{ route('board.exams.index') }}" class="nav-link"> @lang('exams.show all exams') </a></li>
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a  class="nav-link  {{ $dashboard_notifications }}">
						<i class="icon-bell2 "></i>
						<span> @lang('dashboard_notifications.dashboard_notifications') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.dashboard_notifications.create') }}" class="nav-link "> @lang('dashboard_notifications.send new notification') </a></li>
						<li class="nav-item"><a href="{{ route('board.dashboard_notifications.index') }}" class="nav-link"> @lang('dashboard_notifications.show all notifications') </a></li>
					</ul>
				</li>

				

				<li class="nav-item">
					<a href="" class="nav-link ">
						<i class="ph-house"></i>
						<span>
							@lang('dashboard.payments')
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="" class="nav-link ">
						<i class="ph-house"></i>
						<span>
							@lang('dashboard.installments')
						</span>
					</a>
				</li>

			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>