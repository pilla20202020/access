@extends('frontend.layouts.app')

@section('title', 'Enquiry Form')

@section('content')
    <div class="container login-section py-5">
        <div class="row align-center justify-content-center">
            <img src="{{ asset('images/access.png') }}" alt="" class="img-fluid">
            <div class="col-md-12 ">
                <h2 class="text-center pt-5">
                    Verify User Registration
                </h2>
            </div>
        </div>
        <div class="row gx-5 align-center justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="login-form bg-light mt-4 pb-4">
                        <div class="row">
                            <div class="form-group col-12">
                                <input required="required" placeholder="Enter Code" id="code" class="form-control"
                                    name="coupen_code" type="text">
                            </div>
                        </div>



                        <div class="row">
                        <div class="col-lg-12 justify-content-center align-center">
                            <button type="submit" title="Submit Your Message!" class="btn btn-submit" name="submit"
                                value="Submit">Submit</button>
                        </div>
                </div>

            </div>
        </div>

    </div>


    {{-- User Registration Found--}}
    <div class="modal fade user_found" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
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
                    {{-- <form action="{{ route('registration.update') }}" method="GET"
                        class="form form-validate floating-label">
                        @csrf --}}
                        <input type="hidden" class="registration_id" value="" name="registration_id"
                            id="">
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane p-3 active" id="personal" role="tabpanel">
                                    <h5 class="pt-1">Student Detail: </h5>
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

                                    <h5 class="pt-3">Qualification Detail: </h5>
                                    <div class="row">
                                        <div class="col-md-4 mt-2">
                                            <label class="control-label">Highest Qualification</label>
                                            <input type="text" name="highest_qualification" class="form-control reg_highest_qualification" value="" >
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <label class="control-label">Grade</label>
                                            <input type="text" name="highest_grade" class="form-control reg_highest_grade" value="" >
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <label class="control-label">Stream</label>
                                            <input type="text" name="highest_stream" class="form-control reg_highest_stream" value="" >
                                        </div>


                                    </div>

                                    <h5 class="pt-3">Preparation Class Detail: </h5>
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Test Name</label>
                                            <input type="text" name="test_name" class="form-control reg_test_name" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Test Score</label>
                                            <input type="text" name="test_score" class="form-control reg_test_score" value="" >
                                        </div>

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



                                    </div>

                                    <h5 class="pt-3">User Preference: </h5>
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Intrested Country</label>
                                            <input type="text" name="intrested_for_country" class="form-control reg_intrested_for_country" value="" >
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label class="control-label">Intrested Course</label>
                                            <input type="text" name="intrested_course" class="form-control reg_intrested_course" value="" >
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        <!-- Tab panes -->

                        <hr>
                        {{-- <div class="row mt-2 justify-content-center">
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

                        </div> --}}
                    {{-- </form> --}}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- User Registration Not Found Found--}}
    <div class="modal fade user_not_found" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">User Not Found</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center "> Sorry! User not found</h4>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('page-specific-scripts')
    <script>
        $(document).on('click', '.btn-submit', function(e) {
            let code = $('#code').val();
            $.ajax({
                type: 'get',
                url: '{{ route('verify.validate') }}',
                data: {
                    code: code,
                },
                success: function(response) {
                    if (typeof(response) != 'object') {
                        response = JSON.parse(response)
                    }
                    var tbody_html = "";
                    if (response.status     ) {
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
                        $('.user_found').modal('show');
                    } else {
                        $('.user_not_found').modal('show');
                    }
                }

            })
        });
    </script>
@endsection
