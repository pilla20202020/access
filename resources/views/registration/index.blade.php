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
                <div class="table-responsive">

                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
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

    {{-- Add Follow Up Modal --}}
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
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Zone</label>
                                            <input type="text" name="zone" class="form-control reg_zone" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">State</label>
                                            <input type="text" name="state" class="form-control reg_state" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">City</label>
                                            <input type="text" name="city" class="form-control reg_city" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Address</label>
                                            <input type="text" name="address" class="form-control reg_address" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Nearest landmark</label>
                                            <input type="text" name="nearest_landmark" class="form-control reg_nearest_landmark" value="" >
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane p-3" id="academic" role="tabpanel">
                                    <h5>SEE Detail: </h5>
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
                                    <hr>
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
                                <label class="control-label">From</label>
                                <input type="text" name="from" class="form-control" >
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
@stop


@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

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

        $(document).on('click', '.sendsms', function(e) {
            let registration_id = $(this).data('registration_id');
            $(".registration_id").val(registration_id);
            $('.send_sms').modal('show');
        });

        $(document).on('click', '.btn-leadcategory', function(e) {
            let registration_id = $(this).data('registration_id');
            $(".registration_id").val(registration_id);
            $('.show_leadcategory').modal('show');
        });

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
                        $(".reg_zone").val(response.data.zone);
                        $(".reg_state").val(response.data.state);
                        $(".reg_city").val(response.data.city);
                        $(".reg_address").val(response.data.address);
                        $(".reg_nearest_landmark").val(response.data.nearest_landmark);
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
                        $('.update_registration').modal('show');
                    }
                }

            })
        });

        $('.leadcategory').select2();
    </script>
@endsection
