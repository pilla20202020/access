<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
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
                            <li><a href="{{ route('user.index') }}" aria-expanded="false"><i class="fas fa-user"></i></i>
                                    Users</a></li>
                            <li><a href="{{ route('role.index') }}" aria-expanded="false"><i class="fa fa-tasks"></i>
                                    Roles</a></li>
                            <li><a href="{{ route('permission.index') }}" aria-expanded="false"><i class="fa fa-lock"></i>
                                    Permissions</a></li>
                            <li><a href="{{ route('qualification.index') }}" aria-expanded="false"><i
                                        class="fas fa-graduation-cap"></i> Qualification</a></li>
                            <li><a href="{{ route('preparation.index') }}" aria-expanded="false"><i
                                        class="fas fa-tasks"></i> Preparation</a></li>
                            <li><a href="{{ route('leadcategory.index') }}" aria-expanded="false"><i
                                        class="fas fa-list-alt"></i> Lead Category</a></li>
                            <li><a href="{{ route('location.index') }}" aria-expanded="false"><i
                                        class="fa fa-map-marker"></i> Location</a></li>
                        </ul>
                    </li>
                @endrole

                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Registration</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">

                        @role('SuperAdmin')
                            <li class=""><a href="javascript: void(0);" class="has-arrow" aria-expanded="false"><i
                                        class="fas fa-hand-point-right"></i>Campaign</a>

                                @if (getCampaign()->count() > 0)
                                    @foreach (getCampaign() as $campaign)
                                        <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                                            <li class=""><a href="javascript: void(0);" class="has-arrow"
                                                    aria-expanded="false"><i
                                                        class="fas fa-hand-point-right"></i>{{ $campaign->name }}</a>
                                                @if ($campaign->registrations->isEmpty() == false)
                                                    @foreach ($campaign->registrations as $registration)
                                                        <ul class="sub-menu mm-collapse" aria-expanded="true"
                                                            style="height: 0px;">
                                                            <li><a
                                                                    href="{{ route('registration.getregistration_by_campaign_and_leadcategory', ['campaign_id' => $campaign->id, 'leadcategory_id' => $registration->leadcategory_id]) }}"><i
                                                                        class="fas fa-hand-point-right"></i>{{ $registration->leadcategory->name }}</a>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                @endif
                                            </li>
                                        </ul>
                                    @endforeach
                                @endif
                            </li>

                            <li class=""><a href="javascript: void(0);" class="has-arrow" aria-expanded="false"><i
                                        class="fas fa-hand-point-right"></i>Location</a>
                                @if (getLocation()->count() > 0)
                                    @foreach (getLocation() as $location)
                                        <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                                            <li class=""><a href="javascript: void(0);" class="has-arrow"
                                                    aria-expanded="false"><i
                                                        class="fas fa-hand-point-right"></i>{{ $location->name }}</a>
                                                @if ($location->registrations->isEmpty() == false)
                                                    @foreach ($location->registrations as $registration)
                                                        <ul class="sub-menu mm-collapse" aria-expanded="true"
                                                            style="height: 0px;">
                                                            <li><a
                                                                    href="{{ route('registration.getregistration_by_location_and_leadcategory', ['location_slug' => $registration->preffered_location, 'leadcategory_id' => $registration->leadcategory_id]) }}"><i
                                                                        class="fas fa-hand-point-right"></i>{{ $registration->leadcategory->name }}</a>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                @endif
                                            </li>
                                        </ul>
                                    @endforeach
                                @endif
                            </li>
                        @endrole

                        @role('SuperAdmin|Consultancy')
                            <li class=""><a href="{{ route('registration.index') }}"><i
                                        class="fas fa-hand-point-right"></i>View All</a>
                            </li>
                        @endrole
                    </ul>
                </li>


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
