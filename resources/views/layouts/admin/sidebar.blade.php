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
                                                    @foreach ($campaign->registrations->unique('leadcategory_id') as $registration)
                                                        <ul class="sub-menu mm-collapse" aria-expanded="true"
                                                            style="height: 0px;">
                                                            <li><a
                                                                    href="@if(isset($registration->leadcategory_id)) {{ route('registration.getregistration_by_campaign_and_leadcategory', ['campaign_id' => $campaign->id, 'leadcategory_id' => $registration->leadcategory_id]) }} @endif"><i
                                                                        class="fas fa-hand-point-right"></i>@if(isset($registration->leadcategory)) {{ $registration->leadcategory->name }} @endif</a>
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
                                                    @foreach ($location->registrations->unique('leadcategory_id') as $registration)
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
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-settings-outline"></i>
                        <span>Config</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('countries.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Countries</a></li>
                        <li><a href="{{ route('states.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>States</a></li>
                        <li><a href="{{ route('districts.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Districts</a></li>
                        <li><a href="{{ route('colleges.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Colleges</a></li>
                        <li><a href="{{ route('agent.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Agent</a></li>
                        <li><a href="{{ route('location.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Branch/Location</a></li>
                    </ul>
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

                    <li>
                        <a href="{{ route('program.index')}}" aria-expanded="false"><i class="fa fa-tasks"></i> Programs</a>
                    </li>

                    <li>
                        <a href="{{ route('classes.index')}}" aria-expanded="false"><i class="fa fa-tasks"></i> Class</a>
                    </li>

                <li>
                    <a href="{{ route('document_checklist.index')}}" aria-expanded="false"><i class="fas fa-file-archive"></i> Document CheckList</a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-warehouse"></i>
                        <span>Agency</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('student.index')}}" aria-expanded="false"><i class="fas fa-users"></i> Students List</a></li>
                        <li><a href="{{ route('admission.index')}}" aria-expanded="false"><i class="fas fa-university "></i> Admission</a></li>
                        <li><a href="{{ route('admission.getcommencedadmission')}}" aria-expanded="false"><i class="fas fa-user-graduate"></i> Commenced Admission</a></li>
                        <li><a href="{{ route('commission-claim.index')}}" aria-expanded="false"><i class="fas fa-calendar-times"></i> Commission Scheduled Lists</a></li>
                        <li><a href="{{ route('commission-claim.claimed')}}" aria-expanded="false"><i class="fas fa-dollar-sign"></i> Commission Claimed</a></li>
                    </ul>
                </li>
                @endrole



            </ul>
        </div>
    </div>
</div>
