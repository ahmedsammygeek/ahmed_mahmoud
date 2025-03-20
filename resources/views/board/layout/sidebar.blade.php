@php
$groups = $admins = $home = $settings = $teachers = $payments = $students = $educational_systems = $installments = $grades = $dashboard_notifications  = $announcements = $questions = $videos = $trash = $exams = $users = $courses = $slides = $faculties = $universities = $faculty_levels  = $library = $splashes = '';



switch (request()->segment(3)) {
	case 'groups':
	$groups = 'active';
	break;
	case 'announcements':
	$announcements = 'active';
	break;
	case 'splashes':
	$splashes = 'active';
	break;
	case 'educational_systems':
	$educational_systems = 'active';
	break;
	case 'questions':
	$questions = 'active';
	break;
	case 'exams':
	$exams = 'active';
	break;
	case 'teachers':
	$teachers = 'active';
	break;
	case 'students':
	case 'students_videos':
	$students = 'active';
	break;
	case 'users':
	$users = 'active';
	break;
	case 'courses':
	$courses = 'active';
	break;
	case 'admins':
	$admins = 'active';
	break;
	case 'dashboard_notifications':
	$dashboard_notifications = 'active';
	break;
	case 'slides':
	$slides = 'active';
	break;
	case 'grades':
	$grades = 'active';
	break;
	case 'settings':
	$settings = 'active';
	break;
	case 'installments':
	$installments = 'active';
	break;
	case 'payments':
	$payments = 'active';
	break;
	case 'universities':
	$universities = 'active';
	break;
	case 'faculties':
	$faculties = 'active';
	break;
	case 'faculty_levels':
	$faculty_levels = 'active';
	break;
	case 'videos':
	$videos = 'active';
	break;
	case 'trash':
	$trash = 'active';
	break;
	case 'library':
	$library = 'active';
	break;
	default:
	$home = 'active';
	break;
}
@endphp

<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg noprintarea">

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
					<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide"> @lang('board.Main') </div>
					<i class="ph-dots-three sidebar-resize-show"></i>
				</li>
				<li class="nav-item">
					@if (LaravelLocalization::getCurrentLocale() == 'ar' )
					<a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="nav-link " >
						<i class="icon-clear-formatting"></i>
						<span>
							English
						</span>
					</a>
					@else 
					<a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="nav-link " >
						<i class="icon-clear-formatting"></i>
						<span>
							العربيه
						</span>
					</a>
					@endif
				</li>

				<li class="nav-item">
					<a href="{{ route('board.index') }}" class="nav-link {{ $home }}">
						<i class="ph-house"></i>
						<span>
							@lang('dashboard.home')
						</span>
					</a>
				</li>
				@can('edit settings')
				<li class="nav-item">
					<a href="{{ route('board.settings.edit') }}" class="nav-link {{ $settings }}">
						<i class="icon-gear"></i>
						<span>
							@lang('settings.settings')
						</span>
					</a>
				</li>
				@endcan

				@canany(['list all admins', 'add new admin' , 'show admin details' ])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.admins.index') }}" class="nav-link {{ $admins }}">
						<i class="icon-users4"></i>
						<span> @lang('admins.admins') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.admins.create') }}" class="nav-link "> @lang('admins.add new admin') </a></li>
						<li class="nav-item"><a href="{{ route('board.admins.index') }}" class="nav-link"> @lang('admins.show all admins') </a></li>
					</ul>
				</li>
				@endcanany

				@canany(['show slides details', 'list all slides' , 'add new slide'  , 'edit slide details' , 'delete slide' ])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.slides.index') }}" class="nav-link {{ $slides }}">
						<i class="icon-images2"></i>
						<span> @lang('slides.slides') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new slide')
						<li class="nav-item"><a href="{{ route('board.slides.create') }}" class="nav-link "> @lang('slides.add new slide') </a></li>
						@endcan
						<li class="nav-item"><a href="{{ route('board.slides.index') }}" class="nav-link"> @lang('slides.show all slides') </a></li>
					</ul>
				</li>
				@endcanany

				
				@canany(['list all splashes', 'add new splash' , 'show splash details' , 'edit spalsh details' , 'delete splash' ])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.splashes.index') }}" class="nav-link {{ $splashes }}">
						<i class="icon-images2"></i>
						<span> @lang('splashes.splashes') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new splash')
						<li class="nav-item"><a href="{{ route('board.splashes.create') }}" class="nav-link "> @lang('splashes.add new splash') </a></li>
						@endcan
						@can('list all splashes')
						<li class="nav-item"><a href="{{ route('board.splashes.index') }}" class="nav-link"> @lang('splashes.show all splashes') </a></li>
						@endcan
					</ul>
				</li>
				@endcanany
				
				@canany(['add new faculty', 'list all faculties' , 'delete faculty' , 'show faculty details' , 'edit faculty details' ])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.faculties.index') }}" class="nav-link {{ $faculties }}">
						<i class="icon-city "></i>
						<span> @lang('faculties.faculties') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new faculty')
						<li class="nav-item"><a href="{{ route('board.faculties.create') }}" class="nav-link "> @lang('faculties.add new faculty') </a></li>
						@endcan
						@can('list all faculties')
						<li class="nav-item"><a href="{{ route('board.faculties.index') }}" class="nav-link"> @lang('faculties.show all faculties') </a></li>
						@endcan
					</ul>
				</li>
				@endcanany

				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.faculty_levels.index') }}" class="nav-link {{ $faculty_levels }}">
						<i class="icon-quotes-right2 "></i>
						<span> @lang('faculty_levels.faculty_levels') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.faculty_levels.create') }}" class="nav-link "> @lang('faculty_levels.add new level') </a></li>
						<li class="nav-item"><a href="{{ route('board.faculty_levels.index') }}" class="nav-link"> @lang('faculty_levels.show all faculty levels') </a></li>
					</ul>
				</li>

				@canany(['list all universities', 'add new university', 'show university details' , 'edit university details' , 'delete university' ])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.universities.index') }}" class="nav-link {{ $universities }}">
						<i class="icon-office"></i>
						<span> @lang('universities.universities') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new university')
						<li class="nav-item"><a href="{{ route('board.universities.create') }}" class="nav-link "> @lang('universities.add new university') </a></li>
						@endcan
						@can('list all universities')
						<li class="nav-item"><a href="{{ route('board.universities.index') }}" class="nav-link"> @lang('universities.show all universities') </a></li>
						@endcan
					</ul>
				</li>
				@endcanany

				@canany(['list all teachers', 'add new teacher' , 'show teacher details' , 'delete teacher' , 'edit teacher details' ])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.teachers.index') }}" class="nav-link {{ $teachers }}">
						<i class="icon-images2"></i>
						<span> @lang('teachers.teachers') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new teacher')
						<li class="nav-item"><a href="{{ route('board.teachers.create') }}" class="nav-link "> @lang('teachers.add new teacher') </a></li>
						@endcan
						@can('list all teachers')
						<li class="nav-item"><a href="{{ route('board.teachers.index') }}" class="nav-link"> @lang('teachers.show all teachers') </a></li>
						@endcan
					</ul>
				</li>
				@endcanany


				@canany(['list all grades', 'add new grade' , 'show grade details' , 'delete grade' , 'edit grade details'])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.grades.index') }}" class="nav-link {{ $grades }}">
						<i class="icon-graduation2  "></i>
						<span> @lang('grades.grades') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new grade')
						<li class="nav-item"><a href="{{ route('board.grades.create') }}" class="nav-link "> @lang('grades.add new grade') </a></li>
						@endcan
						@can('list all grades')
						<li class="nav-item"><a href="{{ route('board.grades.index') }}" class="nav-link"> @lang('grades.show all grades') </a></li>
						@endcan
					</ul>
				</li>
				@endcanany

				@canany(['list all educational systems'])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.educational_systems.index') }}" class="nav-link {{ $educational_systems }}">
						<i class="icon-keyboard "></i>
						<span> @lang('educational_systems.educational systems') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.educational_systems.create') }}" class="nav-link "> @lang('educational_systems.add new educational system') </a></li>
						<li class="nav-item"><a href="{{ route('board.educational_systems.index') }}" class="nav-link"> @lang('educational_systems.show all educational systems') </a></li>
					</ul>
				</li>
				@endcanany


				@canany(['list all courses', 'edit course details' , 'delete course' , 'show course details' , 'add new course'])
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
				@endcanany
				
				@canany(['list all videos', 'edit video details' , 'delete video' , 'show video details' , 'add new video'])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.videos.index') }}" class="nav-link {{ $videos }}">
						<i class="icon-graduation2  "></i>
						<span> @lang('videos.videos') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new video')
						<li class="nav-item"><a href="{{ route('board.videos.create') }}" class="nav-link "> @lang('videos.add new video') </a></li>
						@endcan
						@can('list all videos')
						<li class="nav-item"><a href="{{ route('board.videos.index') }}" class="nav-link"> @lang('videos.show all videos') </a></li>
						@endcan
					</ul>
				</li>
				@endcanany

				@canany(['list all students', 'show student details' , 'delete student' , 'edit student details' , 'add new student'  ])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.students.index') }}" class="nav-link {{ $students }}">
						<i class="icon-users4"></i>
						<span> @lang('students.students') </span>
					</a>
					<ul class="nav-group-sub collapse">
						
						@can('add new student')
						<li class="nav-item">
							<a href="{{ route('board.students.create') }}" class="nav-link"> 
								@lang('students.add new student') 
							</a>
						</li>
						@endcan

						@can('list all students')
						<li class="nav-item">
							<a href="{{ route('board.students.index') }}" class="nav-link"> 
								@lang('students.show all students')
							</a>
						</li>
						@endcan

						@can('add course to student')
						<li class="nav-item">
							<a href="{{ route('board.students.courses.create_multi') }}" class="nav-link"> 
								add courses
							</a>
						</li>
						@endcan

						@can('disable course for student')
						<li class="nav-item">
							<a href="{{ route('board.students.courses.allow.units') }}" class="nav-link"> 
								disable & allow courses
							</a>
						</li>
						@endcan

						@can('delete course from student')
						<li class="nav-item">
							<a href="{{ route('board.students.courses.remove') }}" class="nav-link"> 
								delete from courses 
							</a>
						</li>
						@endcan

						@can('manipluate student device')
						<li class="nav-item">
							<a href="{{ route('board.students.devices.manipluate') }}" class="nav-link"> 
								students devices manipluate 
							</a>
						</li>
						@endcan


						@can('manipluate student course views')
						<li class="nav-item">
							<a href="{{ route('board.students.videos') }}" class="nav-link"> 
								views  manipluate 
							</a>
						</li>

						@endcan
					</ul>
				</li>
				@endcanany
				

				@canany(['add new file to library' , 'add student to library' ])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.library.index') }}" class="nav-link {{ $library }}">
						<i class="icon-file-pdf "></i>
						<span> @lang('library.library') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item">
							<a href="{{ route('board.library.index') }}" class="nav-link "> 
								@lang('library.show library files') 
							</a>
						</li>
						@can('add new file to library')
						<li class="nav-item">
							<a href="{{ route('board.library.create') }}" class="nav-link "> 
								@lang('library.add new file') 
							</a>
						</li>
						@endcan
						@can('add student to library')
						<li class="nav-item">
							<a href="{{ route('board.library.students') }}" class="nav-link "> 
								@lang('library.assgin students') 
							</a>
						</li>
						@endcan
					</ul>
				</li>
				@endcanany


				@canany(['list all groups', 'add new group' , 'show group details' , 'edit group details' , 'delete group'])
				<li class="nav-item nav-item-submenu">
					<a href="{{ route('board.groups.index') }}" class="nav-link {{ $groups }} ">
						<i class="icon-make-group "></i>
						<span> @lang('groups.groups') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new group')
						<li class="nav-item"><a href="{{ route('board.groups.create') }}" class="nav-link "> @lang('groups.add new gourp') </a></li>
						@endcan
						@can('list all groups')
						<li class="nav-item"><a href="{{ route('board.groups.index') }}" class="nav-link"> @lang('groups.show all groups') </a></li>
						@endcan
					</ul>
				</li>
				@endcanany


				@canany(['list all questions', 'add new question' , 'edit question details' , 'delete question' , 'show question details' ])
				<li class="nav-item nav-item-submenu">
					<a  href="{{ route('board.questions.index') }}"  class="nav-link {{ $questions }} "  >
						<i class="icon-question7 "></i>
						<span> @lang('questions.questions') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new question')
						<li class="nav-item"><a href="{{ route('board.questions.create') }}" class="nav-link"> @lang('questions.add new question') </a></li>
						@endcan
						@can('list all questions')
						<li class="nav-item"><a href="{{ route('board.questions.index') }}" class="nav-link"> @lang('questions.show all questions') </a></li>
						@endcan
					</ul>
				</li>
				@endcanany



				@canany(['list all exams', 'add new exam' , 'show exam details' , 'edit exam details' , 'delete exam' ])
				<li class="nav-item nav-item-submenu">
					<a  class="nav-link  {{ $exams }}">
						<i class="icon-compose "></i>
						<span> @lang('exams.exams') </span>
					</a>
					<ul class="nav-group-sub collapse">
						@can('add new exam')
						<li class="nav-item"><a href="{{ route('board.exams.create') }}" class="nav-link "> @lang('exams.add new exams') </a></li>
						@endcan
						@can('list all exams')
						<li class="nav-item"><a href="{{ route('board.exams.index') }}" class="nav-link"> @lang('exams.show all exams') </a></li>
						@endcan
					</ul>
				</li>
				@endcanany
				
				@canany(['policy', 'policy'])
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
				@endcanany

				@canany(['list all announcements'], Model::class)
				<li class="nav-item nav-item-submenu">
					<a  class="nav-link  {{ $announcements }}">
						<i class="icon-bell2 "></i>
						<span> @lang('announcements.announcements') </span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.announcements.create') }}" class="nav-link "> @lang('announcements.send new announcement') </a></li>
						<li class="nav-item"><a href="{{ route('board.announcements.index') }}" class="nav-link"> @lang('announcements.show all announcements') </a></li>
					</ul>
				</li>
				@endcanany


				@canany(['list all payments'])
				<li class="nav-item">
					<a href="{{ route('board.payments.index') }}" class="nav-link ">
						<i class="ph-money "></i>
						<span>
							@lang('dashboard.payments')
						</span>
					</a>
				</li>
				@endcanany
				

				
				@canany(['list all installments'])
				<li class="nav-item">
					<a href="{{ route('board.installments.index') }}" class="nav-link {{ $installments }} ">
						<i class="ph-currency-circle-dollar "></i>
						<span>
							@lang('dashboard.installments')
						</span>
					</a>
				</li>
				@endcanany

				@canany(['list all trashes'])
				<li class="nav-item nav-item-submenu">
					<a  class="nav-link {{ $trash }} ">
						<i class="icon-trash "></i>
						<span>
							@lang('dashboard.trash.index')
						</span>
					</a>

					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ route('board.trashed.students') }}" class="nav-link "> @lang('trash.students') </a></li>
						<li class="nav-item"><a href="{{ route('board.trashed.courses') }}" class="nav-link"> @lang('trash.courses') </a></li>
						<li class="nav-item"><a href="{{ route('board.trashed.lessons') }}" class="nav-link"> @lang('trash.lessons') </a></li>
						<li class="nav-item"><a href="{{ route('board.trashed.students_courses') }}" class="nav-link"> @lang('trash.students_courses') </a></li>
					</ul>

				</li>
				@endcanany


			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>