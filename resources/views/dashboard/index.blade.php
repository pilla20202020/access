@extends('layouts.admin.admin')
@section('title', 'New Project')


@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('content')
            <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">New Project</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                {{-- Campaign Lists --}}
                <div class="col-xl-12 p-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Campaign Lists</h5>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-hover display example">
                                            <thead>
                                                <tr>
                                                    <th>S.N.</th>
                                                    <th>Name</th>
                                                    <th>Detail</th>
                                                    <th>Starts</th>
                                                    <th>Ends</th>
                                                    <th>Total Enquiry</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($campaigns as $key => $campaign)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{ Str::limit($campaign->name, 47) }}</td>
                                                    <td>{{ Str::limit($campaign->details, 47) }}</td>
                                                    <td>{{ Str::limit($campaign->starts, 47) }}</td>
                                                    <td>{{ Str::limit($campaign->ends, 47) }}</td>
                                                    <td>{{ $campaign->registrations->count() }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end table-responsive-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Recent Enquiry Lists --}}

                {{-- Recent Enquiry Lists --}}
                <div class="col-xl-12 p-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Recent Enquiry Lists</h5>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-hover display example">
                                            <thead>
                                                <tr>
                                                    <th>S.N.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registrations as $key => $registration)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{ Str::limit($registration->name, 47) }}</td>
                                                    <td>{{ Str::limit($registration->email, 47) }}</td>
                                                    <td>{{ Str::limit($registration->phone, 47) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end table-responsive-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Recent Enquiry Lists --}}




                {{-- Upcoming Follow Up Lists --}}
                <div class="col-xl-12 p-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Upcoming Follow Up Lists</h5>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-hover display example">
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Follow Up By</th>
                                                    <th>Follow Up Dates</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($followups as $followup)
                                                    @if(($followup->follow_up_type == "registration") && !empty($followup->registration($followup->id)))
                                                        <tr>
                                                            <td>
                                                                {{ $followup->registration($followup->id)->name}}
                                                            </td>
                                                            <td>
                                                                {{ $followup->registration($followup->id)->email}}
                                                            </td>

                                                            <td>
                                                                {{ $followup->registration($followup->id)->phone}}
                                                            </td>
                                                            <td>
                                                                {{ $followup->follow_up_by}}
                                                            </td>
                                                            <td>{{$followup->next_schedule}}</td>
                                                            <td>{{$followup->remarks}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end table-responsive-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Upcoming Follow Up Lists --}}





        <!-- End Page-content -->
    </div>
@endsection

@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.example').DataTable();
        } );
    </script>
@endsection
