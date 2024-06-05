<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- Sidebar header -->
				<div class="sidebar-section">
					<div class="sidebar-section-body d-flex justify-content-center">
						<h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

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
							<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide"> لوحه التحكم </div>
							<i class="ph-dots-three sidebar-resize-show"></i>
						</li>
						<li class="nav-item">
							<a href="{{ route('board.index') }}" class="nav-link active">
								<i class="ph-house"></i>
								<span>
									الرئيسيه
								</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{ route('board.index') }}" class="nav-link ">
								<i class="ph-gear"></i>
								<span>
									الاعدادات
								</span>
							</a>
						</li>

						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-users "></i>
								<span> المشرفين </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="{{ route('board.admins.index') }}" class="nav-link active"> عرض كافه المشرفين </a></li>
								<li class="nav-item"><a href="{{ route('board.admins.create') }}" class="nav-link">إضافه مشرف جديد</a></li>
							</ul>
						</li>


						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-users-four "></i>
								<span> المستخدمين </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="" class="nav-link active"> عرض كافه المستخدمين </a></li>
							</ul>
						</li>

						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-image "></i>
								<span> عارض الصور </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="{{ route('board.slides.index') }}" class="nav-link active"> عرض كافه الصور </a></li>
								<li class="nav-item"><a href="{{ route('board.slides.create') }}" class="nav-link">إضافه صوره جديده</a></li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-chart-pie-slice"></i>
								<span> الاقسام </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="{{ route('board.categories.index') }}" class="nav-link active"> عرض كافه الاقسام </a></li>
								<li class="nav-item"><a href="{{ route('board.categories.create') }}" class="nav-link">إضافه قسم جديد</a></li>
							</ul>
						</li>

						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-circles-four "></i>
								<span> الاصناف </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="{{ route('board.items.index') }}" class="nav-link active"> عرض كافه الاصناف </a></li>
								<li class="nav-item"><a href="{{ route('board.items.create') }}" class="nav-link">إضافه صنف جديد</a></li>
							</ul>
						</li>


						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-graph "></i>
								<span> العلامات التجاريه </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="{{ route('board.brands.index') }}" class="nav-link active"> عرض كافه العلامات التجاريه </a></li>
								<li class="nav-item"><a href="{{ route('board.brands.create') }}" class="nav-link">إضافه علامه جديده</a></li>
							</ul>
						</li>


						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-map-pin-line "></i>
								<span> المحافظات </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="{{ route('board.governorates.index') }}" class="nav-link active"> عرض كافه المحافظات </a></li>
								<li class="nav-item"><a href="{{ route('board.governorates.create') }}" class="nav-link">إضافه محافظه جديده</a></li>
							</ul>
						</li>



						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-map-trifold "></i>
								<span> المدن </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="{{ route('board.cities.index') }}" class="nav-link active"> عرض كافه المدن </a></li>
								<li class="nav-item"><a href="{{ route('board.cities.create') }}" class="nav-link">إضافه مدينه جديده</a></li>
							</ul>
						</li>


						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-trash "></i>
								<span> طلبات جمع المخلفات </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="" class="nav-link active"> عرض كافه الطلبات </a></li>
							</ul>
						</li>


						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-notification "></i>
								<span> الاشرعات </span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="" class="nav-link active"> ارسال اشعار جديد </a></li>
							</ul>
						</li>
						
						<!-- /page kits -->

					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>