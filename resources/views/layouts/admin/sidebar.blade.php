<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @role('SuperAdmin')

                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('user.index')}}" aria-expanded="false"><i class="fas fa-user"></i></i> Users</a></li>
                        <li><a href="{{ route('role.index')}}" aria-expanded="false"><i class="fa fa-tasks"></i> Roles</a></li>
                        <li><a href="{{ route('permission.index')}}" aria-expanded="false"><i class="fa fa-lock"></i> Permissions</a></li>
                        <li><a href="{{ route('qualification.index')}}" aria-expanded="false"><i class="fas fa-graduation-cap"></i> Qualification</a></li>
                        <li><a href="{{ route('preparation.index')}}" aria-expanded="false"><i class="fas fa-tasks"></i> Preparation</a></li>
                        <li><a href="{{ route('leadcategory.index')}}" aria-expanded="false"><i class="fas fa-list-alt"></i> Lead Category</a></li>
                        <li><a href="{{ route('location.index')}}" aria-expanded="false"><i class="fa fa-map-marker"></i> Location</a></li>
                    </ul>
                </li>
                @endrole

                @role('SuperAdmin|Consultancy')
                    <li>
                        <a href="{{ route('registration.index') }}" class="waves-effect">
                            <i class="mdi mdi-folder"></i>
                            <span>Registration Enquiry</span>
                        </a>
                    </li>
                @endrole

                @role('SuperAdmin')
                <li>
                    <a href="{{ route('campaign.index') }}" class="waves-effect">
                        <i class="mdi mdi-trophy"></i>
                        <span>Campaign</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('followup.index') }}" class="waves-effect">
                        <i class="fa fa-bookmark"></i>
                        <span>Follow Up</span>
                    </a>
                </li>
                @endrole


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
