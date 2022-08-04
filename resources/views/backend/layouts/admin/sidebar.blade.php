<!-- BEGIN MENUBAR-->
<div id="menubar" class="menubar-inverse ">
				<div class="menubar-fixed-panel">
					<div>
						<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
							<i class="fa fa-bars"></i>
						</a>
					</div>
					<div class="expanded">
						<a href="{{ route('dashboard.index') }}">
							<span class="text-lg text-bold text-primary ">MATERIAL&nbsp;ADMIN</span>
						</a>
					</div>
				</div>
				<div class="menubar-scroll-panel">

					<!-- BEGIN MAIN MENU -->
					<ul id="main-menu" class="gui-controls">

						<!-- BEGIN DASHBOARD -->
						<li>
							<a href="{{ route('dashboard.index') }}" class="active">
								<div class="gui-icon"><i class="md md-home"></i></div>
								<span class="title">Dashboard</span>
							</a>
						</li><!--end /menu-li -->
						<!-- END DASHBOARD -->

					</li>

					<li class="gui-folder">
						<a href="{{ route('registration.index') }}">
							<div class="gui-icon"><i class="md md-folder"></i></div>
							<span class="title">Registration Enquiry</span>
						</a>
					</li>

                    <li class="gui-folder">
						<a href="{{ route('campaign.index') }}">
							<div class="gui-icon"><i class="md md-folder"></i></div>
							<span class="title">Campaign</span>
						</a>
					</li>

					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
							<span class="opacity-75">Copyright &copy; 2021</span> <strong>Project</strong>
						</small>
					</div>
				</div><!--end .menubar-scroll-panel-->
			</div><!--end #menubar-->
			<!-- END MENUBAR -->
