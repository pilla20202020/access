@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}" />
@endsection

@section('title', 'Registration')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Registration Lists</header>
            </div>
            <div class="card mt-2 p-4">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="country" class="form-label">Bulk Option</label>
                                <select name="bulk_option" id="bulk_option" class="form-control bulk_option" required >
                                    <option value="" selected disabled >Select Bulk Option</option>
                                    <option value="sms" >Bulk SMS</option>
                                    <option value="lead" >Bulk Lead Status Change</option>
                                    <option value="location" >Bulk Location Transfer</option>
                                    <option value="newsletter" >Bulk Newsletter</option>
                                </select>
                                <div class="error d-none pt-1 pl-2">Please Select At Least One Option</div>
                                <div class="clearix"></div>
                            </div>
                        </div>

                        <div class="col-sm-2 mt-5">
                            <input id="selectAll" type="checkbox">
                            <label for="selectAll">Select All</label>
                        </div>

                        <div class="col-sm-2 mt-4">
                            <button type="submit" class="btn btn-primary ink-reaction bulk_submit mt-1">Submit</button>
                        </div>
                    </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Checkbox</th>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Source</th>
                                <th>Preferred Location </th>
                                <th>Coupen Code </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @each('registration.partials.table', $registrations, 'registration')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Update Registration --}}
    <div class="modal fade update_registration" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Detail of <span class="student_name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('registration.update') }}" method="GET"
                        class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="registration_id" value="" name="registration_id"
                            id="">
                        <div class="row justify-content-center mb-3">
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#personal" role="tab"
                                        aria-selected="true">Personal Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#academic" role="tab"
                                        aria-selected="true">Academic Details</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#language" role="tab"
                                        aria-selected="false">Language/Tests
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#preferance" role="tab"
                                        aria-selected="false">User Preference
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane p-3 active" id="personal" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Student Name</label>
                                            <input type="text" name="name" class="form-control reg_name" value="" required>
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" class="form-control reg_email" value="" required>
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <label class="control-label">Phone</label>
                                            <input type="number" name="phone" class="form-control reg_phone" value="" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Address: </h5>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="specialization" class="col-form-label pt-0">Select Country</label>
                                                <div class="">
                                                    <select data-placeholder="Select Country"
                                                        class="form-control country_id reg_country" id="country_id"
                                                        name="country_id">
                                                        <option value="" disabled selected>Select Country</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}" @if (isset($student) && $student->country_id == $country->id) selected @endif>
                                                                {{ ucfirst($country->country_name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="province" class="col-form-label pt-0">Select Province/State</label>
                                                <div class="">
                                                    <select data-placeholder="Select Province"
                                                        class="tail-select form-control state_class reg_state" id="province_id"
                                                        name="state_id">
                                                        <option value="" selected disabled >Select Province</option>
                                                        @if(isset($states))
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->id }}" @if (isset($student) && $student->state_id == $state->id) selected @endif>
                                                                {{ $state->state_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="districts" class="col-form-label pt-0">Select District</label>
                                                <div class="">
                                                    <select data-placeholder="Select District"
                                                        class="tail-select form-control district_class reg_district" id="district_id"
                                                        name="district_id">
                                                        <option value="" selected disabled>Select District</option>
                                                        @if(isset($districts))
                                                            @foreach ($districts as $district)
                                                                <option value="{{ $district->id }}" @if (isset($student) && $student->district_id == $district->id) selected @endif>
                                                                    {{ $district->district_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="municipality"
                                                    class="col-form-label pt-0">Metro/Sub-Metro/Municipality/VDC</label>
                                                <input type="text" class="form-control reg_municipality" name="municipality_name"
                                                    placeholder="Municipality" value="{{ old('municipality_name', isset($student->municipality_name) ? $student->municipality_name : '') }}">

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="municipality" class="col-form-label pt-0">Ward No.</label>
                                                <input type="number" class="form-control reg_ward" name="ward_no" placeholder="Ward" value="{{ old('ward_no', isset($student->ward_no) ? $student->ward_no : '') }}">

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="municipality" class="col-form-label pt-0">Village/Town/City</label>
                                                <input type="text" class="form-control reg_village" name="village_name" value="{{ old('village_name', isset($student->village_name) ? $student->village_name : '') }}">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane p-3" id="academic" role="tabpanel">
                                    {{-- <h5>SEE Detail: </h5>
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">SEE Year</label>
                                            <input type="text" name="see_year" class="form-control reg_see_year" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">SEE Grade</label>
                                            <input type="text" name="see_grade" class="form-control reg_see_grade" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">SEE Stream</label>
                                            <input type="text" name="see_stream" class="form-control reg_see_stream" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">SEE School</label>
                                            <input type="text" name="see_school" class="form-control reg_see_school" value="" >
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>+2 Detail: </h5>
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">+2 Year</label>
                                            <input type="text" name="plus2_year" class="form-control reg_plus2_year" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">+2 Grade</label>
                                            <input type="text" name="plus2_grade" class="form-control reg_plus2_grade" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">+2 Stream</label>
                                            <input type="text" name="plus2_stream" class="form-control reg_plus2_stream" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">+2 College</label>
                                            <input type="text" name="plus2_college" class="form-control reg_plus2_college" value="" >
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Bachelors Detail: </h5>
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Bachelors Year</label>
                                            <input type="text" name="bachelors_year" class="form-control reg_bachelors_year" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Bachelors Grade</label>
                                            <input type="text" name="bachelors_grade" class="form-control reg_bachelors_grade" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Bachelors Stream</label>
                                            <input type="text" name="bachelors_stream" class="form-control reg_bachelors_stream" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Bachelors College</label>
                                            <input type="text" name="bachelors_college" class="form-control reg_bachelors_college" value="" >
                                        </div>
                                    </div>
                                    <hr> --}}
                                    <h5>Highest Qualification Detail: </h5>
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Highest Qualification Year</label>
                                            <input type="text" name="highest_qualification" class="form-control reg_highest_qualification" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Highest Qualification Grade</label>
                                            <input type="text" name="highest_grade" class="form-control reg_highest_grade" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Highest Qualification Stream</label>
                                            <input type="text" name="highest_stream" class="form-control reg_highest_stream" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Highest Qualification College</label>
                                            <input type="text" name="highest_college" class="form-control reg_highest_college" value="" >
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane p-3" id="language" role="tabpanel">
                                    <h5>Preparation Class Detail: </h5>
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Preparation Class Year</label>
                                            <input type="text" name="preparation_class" class="form-control reg_preparation_class" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Preparation Class Score</label>
                                            <input type="text" name="preparation_score" class="form-control reg_preparation_score" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">BandScore</label>
                                            <input type="text" name="preparation_bandscore" class="form-control reg_preparation_bandscore" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Preparation Date</label>
                                            <input type="date" name="preparation_date" class="form-control preparation_date" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Test Name</label>
                                            <input type="text" name="test_name" class="form-control reg_test_name" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Test Score</label>
                                            <input type="text" name="test_score" class="form-control reg_test_score" value="" >
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane p-3" id="preferance" role="tabpanel">
                                    <h5>User Preference: </h5>
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Intrested Country</label>
                                            <input type="text" name="intrested_for_country" class="form-control reg_intrested_for_country" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Intrested Course</label>
                                            <input type="text" name="intrested_course" class="form-control reg_intrested_course" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Preffered Location</label>
                                            <input type="text" name="preffered_location" class="form-control reg_preffered_location" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Tab panes -->

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group mr-1">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light"
                                        value="Save Changes">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- Add Follow Up Modal --}}
    <div class="modal fade add_followup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Add Follow Up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('registration.addfollowup') }}" method="POST"
                        class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="registration_id" value="" name="refrence_id"
                            id="">
                        <input type="hidden" class="follow_up_type" value="registration" name="follow_up_type"
                            id="">
                        <div class="row justify-content-center">

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Next Schedule</label>
                                <input type="date" name="next_schedule" class="form-control" >
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Remarks</label>
                                <textarea name="remarks" class="form-control" ></textarea>
                            </div>


                            @if (isset($leadCategories))
                                <div class="col-md-12 mt-2">
                                    <label for="Name">Follow Up Option</label>
                                    <select name="leadcategory_id" class="form-control">
                                        @foreach ($leadCategories as $category)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span
                                        class="text-danger">{{ $errors->has('leadcategory_id') ? $errors->first('leadcategory_id') : '' }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <h6>Previous List of Follow Ups</h6>
                        <thead class="thead-light">
                            <tr>
                                <th>S.No.</th>
                                <th>Follow Up By</th>
                                <th>Next Schedule</th>
                                <th>Remarks</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                        </thead>
                        <tbody id="followuplist">

                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- Add SMS --}}
    <div class="modal fade send_sms" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Send SMS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('registration.send_sms') }}" method="POST"
                        class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="registration_id" value="" name="registration_id"
                            id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">To</label>
                                <input type="text" name="from" class="form-control sms_to" >
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Message</label>
                                <textarea name="message" class="form-control" ></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- Update Lead Category --}}
    <div class="modal fade show_leadcategory" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Update Lead Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('registration.update_lead_category') }}" method="POST"
                        class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="registration_id" value="" name="registration_id"
                            id="">
                        <div class="row justify-content-center">
                            @if (isset($leadCategories))
                                <div class="col-md-12 mt-2">
                                    <label for="Name">Follow Up Option</label>
                                    <select name="leadcategory_id" class="form-control">
                                        @foreach ($leadCategories as $category)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span
                                        class="text-danger">{{ $errors->has('leadcategory_id') ? $errors->first('leadcategory_id') : '' }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- Bulk SMS MOdal --}}
    <div class="modal fade bulk_sms" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Send SMS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row justify-content-center">
                            {{-- <div class="col-md-12 mt-2">
                                <label class="control-label">To</label>
                                <input type="text" name="option_from" class="form-control option_from" >
                            </div> --}}

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Message</label>
                                <textarea name="option_message" class="form-control option_message" ></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light btn-ok"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- Bulk Lead Modal --}}
    <div class="modal fade bulk_lead" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Update Lead Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row justify-content-center">
                            @if (isset($leadCategories))
                                <div class="col-md-12 mt-2">
                                    <label for="Name">Follow Up Option</label>
                                    <select name="option_leadstatus" class="form-control option_leadstatus">
                                        @foreach ($leadCategories as $category)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span
                                        class="text-danger">{{ $errors->has('option_leadstatus') ? $errors->first('option_leadstatus    ') : '' }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light btn-ok"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- Bulk Location Update Modal --}}
    <div class="modal fade bulk_location" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Update Lead Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row justify-content-center">
                            @if (isset($leadCategories))
                                <div class="col-md-12 mt-2">
                                    <label for="Name">Follow Up Option</label>
                                    <select name="option_location" class="form-control option_location">
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->slug }}" selected>{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    <span
                                        class="text-danger">{{ $errors->has('option_location') ? $errors->first('option_location') : '' }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light btn-ok"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- Bulk NewsLetter Modal --}}
    <div class="modal fade bulk_newsletter" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Update Lead Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label for="Name">NewsLetter</label>
                                <textarea name="newsletter" id="option_newsletter" class="ckeditor option_newsletter"></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light btn-ok"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@stop


@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable({
                dom: 'Bfrtip',
                
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 2, 3, 4, 5, 6, 7 ]
                    },
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 2, 3, 4, 5, 6, 7 ]
                    }
                },
            ]
            });
        });

        // Add Followup
        $(document).on('click', '.addfollowup', function(e) {
            let registration_id = $(this).data('registration_id');
            $(".registration_id").val(registration_id);
            $.ajax({
                type: 'get',
                url: '{{ route('registration.viewfollowup') }}',
                data: {
                    registration_id: registration_id,
                },
                success: function(response) {
                    if (typeof(response) != 'object') {
                        response = JSON.parse(response)
                    }
                    var tbody_html = "";
                    if (response.status) {
                        $.each(response.data, function(key, followup) {
                            key = key + 1;
                            tbody_html += "<tr>";
                            tbody_html += "<td>" + key + "</td>";
                            tbody_html += "<td>" + followup.follow_up_by + "</td>";
                            tbody_html += "<td>" + followup.next_schedule + "</td>";
                            tbody_html += "<td>" + followup.remarks + "</td>";
                            tbody_html += "</tr>";
                        });
                        $('#followuplist').html(tbody_html);
                        $('.add_followup').modal('show');
                    }
                }

            })

        });
        // Add Followup

        // Send SMS
        $(document).on('click', '.sendsms', function(e) {
            let registration_id = $(this).data('registration_id');
            let phone = $(this).parent().prev().prev().text();
            $(".registration_id").val(registration_id);
            $(".sms_to").val(phone);
            $('.send_sms').modal('show');
        });
        // Send SMS

        // Procceed To Enroll
        $(document).on('click', '.btn-enrolled', function(e) {
            let registration_id = $(this).data('registration_id');
            $(".registration_id").val(registration_id);
            $('.show_enrolled').modal('show');
        });
        // Procceed To Enroll

        // Update Lead Category
        $(document).on('click', '.btn-leadcategory', function(e) {
            let registration_id = $(this).data('registration_id');
            $(".registration_id").val(registration_id);
            $('.show_leadcategory').modal('show');
        });
        // Update Lead Category

        // Update Registration Modal
        $(document).on('click', '.btn-edit', function(e) {
            let registration_id = $(this).data('registration_id');
            $(".registration_id").val(registration_id);
            $.ajax({
                type: 'get',
                url: '{{ route('registration.getregistration') }}',
                data: {
                    registration_id: registration_id,
                },
                success: function(response) {
                    if (typeof(response) != 'object') {
                        response = JSON.parse(response)
                    }
                    var tbody_html = "";
                    if (response.status) {
                        $(".student_name").text(response.data.name);
                        $(".reg_name").val(response.data.name);
                        $(".reg_email").val(response.data.email);
                        $(".reg_phone").val(response.data.phone);
                        $(".reg_see_year").val(response.data.see_year);
                        $(".reg_see_grade").val(response.data.see_grade);
                        $(".reg_see_stream").val(response.data.see_stream);
                        $(".reg_see_school").val(response.data.see_school);
                        $(".reg_plus2_year").val(response.data.plus2_year);
                        $(".reg_plus2_grade").val(response.data.plus2_grade);
                        $(".reg_plus2_stream").val(response.data.plus2_stream);
                        $(".reg_plus2_college").val(response.data.plus2_college);
                        $(".reg_bachelors_year").val(response.data.bachelors_year);
                        $(".reg_bachelors_grade").val(response.data.bachelors_grade);
                        $(".reg_bachelors_stream").val(response.data.bachelors_stream);
                        $(".reg_bachelors_college").val(response.data.bachelors_college);
                        $(".reg_highest_qualification").val(response.data.highest_qualification);
                        $(".reg_highest_grade").val(response.data.highest_grade);
                        $(".reg_highest_stream").val(response.data.highest_stream);
                        $(".reg_highest_college").val(response.data.highest_college);
                        $(".reg_preparation_class").val(response.data.preparation_class);
                        $(".reg_preparation_score").val(response.data.preparation_score);
                        $(".reg_preparation_bandscore").val(response.data.preparation_bandscore);
                        $(".reg_preparation_date").val(response.data.preparation_date);
                        $(".reg_test_name").val(response.data.test_name);
                        $(".reg_test_score").val(response.data.test_score);
                        $(".reg_intrested_for_country").val(response.data.intrested_for_country);
                        $(".reg_intrested_course").val(response.data.intrested_course);
                        $(".reg_preffered_location").val(response.data.preffered_location);
                        $(".reg_country").val(response.data.country_id).attr("selected","selected");
                        $(".reg_state").val(response.data.state_id).attr("selected","selected");
                        $(".reg_district").val(response.data.district_id).attr("selected","selected");
                        $(".reg_municipality").val(response.data.municipality_name);
                        $(".reg_ward").val(response.data.ward_no);
                        $(".reg_village").val(response.data.village_name);
                        $('.update_registration').modal('show');
                    }
                }

            })
        });
        // Update Registration Modal
        var bulkoption;
        var registration = [];

        // Bulk Option Modal Pop Up

        $(document).ready(function() {

            $('.bulk_submit').on('click',function() {
                if($('.registrationcheckbox:checkbox:checked').length == 0 ) {
                    alert('Please at least one checkbox');
                    return false
                }
                if($("#bulk_option")[0].selectedIndex === 0) {
                    $('.error').removeClass('d-none');
                    return false
                }
                bulkoption = $('.bulk_option').val();
                if(bulkoption == "sms") {
                    $('.bulk_sms').modal('show');
                }
                if(bulkoption == "lead") {
                    $('.bulk_lead').modal('show');
                }
                if(bulkoption == "location") {
                    $('.bulk_location').modal('show');
                }
                if(bulkoption == "newsletter") {
                    $('.bulk_newsletter').modal('show');
                }

                var incr=0;
                $('input[name="registrationcheckbox"]:checked').each(function() {
                    if (this.checked) {
                        registration[incr]=(this.value);
                        incr++;
                    }
                });
            })

            $("#selectAll").click(function(){
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });
        });
        // Bulk Option Modal Pop Up


        // Bulk Option Submit
        $(document).ready(function() {
            $('.btn-ok').on('click',function() {
                var option_from = $('.option_from').val();
                var option_message = $('.option_message').val();
                var option_leadstatus = $('.option_leadstatus').val();
                var option_location = $('.option_location').val();
                var option_newsletter = CKEDITOR.instances["option_newsletter"].getData();
                $.ajax({
                    url: "{{route('registration.bulkupdate')}}",
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        registration_id: registration,
                        bulkoption: bulkoption,
                        option_from: option_from,
                        option_message: option_message,
                        option_leadstatus: option_leadstatus,
                        option_location: option_location,
                        option_newsletter: option_newsletter,
                    },
                    success:function(status){
                        window.location.reload();
                    }

                })
            })
        });
        // Bulk Option Submit

        $('.leadcategory').select2();
        $(function () {
            $('.ckeditor').each(function (e) {
            });
        });

        $(".table tbody tr").click(function(e) {
            if($(e.target).is(':checkbox')) return; //ignore when click on the checkbox

            var $cb = $(this).find(':checkbox');
            $cb.prop('checked', !$cb.is(':checked'));
        });

        function proceedThis(obj) {
                let data= obj.getAttribute("link");
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Proceed Forward'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = data;
                    Swal.fire(
                    'Sent!',
                    'Now you can proceed for admission.',
                    'success'
                    )
                } else {
                    Swal.fire(
                    'Cancelled!',
                    'Proceed has been Cancelled.',
                    'error'
                    )
                }
                })
            }

        var provincesByCountryId = "{{ route('common.state.countryId') }}";
        var districtByProvinceId = "{{ route('common.district.provinceId') }}";

    </script>
    <script src="{{ asset('js/student/student.js') }}"></script>
@endsection
