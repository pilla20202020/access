@extends('frontend.layouts.app')

@section('title', 'Enquiry Form')

@section('content')
    <div class="container login-section py-5">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('images/access.png') }}" alt="" class="img-fluid">
            </div>
            <div class="col-md-9">
                <!--h2 class="login-right-title pt-5">
                    @if(isset($campaign))
                        {{$campaign->name}}
                    @endif
                </h2-->
            </div>
        </div>
        <div class="row gx-5">
            <div class="col-lg-7 col-md-8">
                <div class="login-form bg-light mt-4 pb-4">

                    @if(isset($campaign) && $campaign->banner)
                        <img class="img-fluid" src="{{ asset($campaign->banner_path)}}"/>
                    @endif
                    @if(Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success mt-3 mb-3" id="alert_message">
                            {{Illuminate\Support\Facades\Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h5 class="login_welcome text-center pt-4 pb-1">Register now for Appointments</h5>
                    <form method="GET" id="enquiry_form" name="enq" action="{{ route('customerform.store',['headers'=> $campaign->name, 'user_agent'=> $campaign->id]) }}" class="p-3">
                        @csrf
                        @if(isset($campaign))
                            <input type="hidden" name="campaign_id" id="" value="{{$campaign->id}}">
                        @endif
                        <input type="hidden" name="source" id="" value="registration">
                        <div class="row">
                            <div class="form-group col-12">
                                <input required="required" placeholder="Enter Name" id="first-name" class="form-control"
                                    name="name" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-8">
                                <input required="required" placeholder="Enter Email" id="email" class="form-control"
                                    name="email" type="email">
                            </div>

                            <div class="form-group col-4">
                                <input required="required" placeholder="Enter Phone" id="phone" class="form-control"
                                    name="phone" type="number">
                            </div>
                        </div>


                        <div class="row">

                            <div class="form-group col-4">
                                <select name="highest_qualification" class="form-control">
                                    <option value="" disabled selected>Select Qualification</option>
                                    @foreach ($qualifications as $qualification)
                                        <option value="{{$qualification->name}}">{{$qualification->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-4">
                                <input placeholder="Grade" class="form-control"
                                    name="highest_grade" type="text">

                            </div>

                            <div class="form-group col-4">
                                <input placeholder="Stream" class="form-control"
                                    name="highest_stream" type="text">

                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col-6">
                                <select name="test_name" class="form-control">
                                    <option value="" disabled selected>Select Test Preparation</option>
                                    @foreach ($preparations as $preparation)
                                        <option value="{{$preparation->name}}">{{$preparation->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-6">
                                <input placeholder="Enter Test Score " class="form-control"
                                    name="test_score" type="text">
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="form-group col-md-12">
                                <select class="form-select form-control" name="preffered_location" aria-label="Default select example">
                                    <option selected disabled>Registering For</option>
                                    <option value="baneshwor">NZ Admission Day New Baneshor (24 August)</option>
                                    <option value="biratnagar">NZ Admission Day Biratnagar (25 August)</option>
                                    <option value="pokhara">NZ Admission Day Pokhara (26 August)</option>
                                    <option value="chitwan">NZ Admission Day Chitwan (28 August)</option>
                                    <option value="butwal">NZ Admission Day Butwal (29 August)</option>
                                    <option value="putalisadak">NZ Admission Day Putalisadak (30 August)</option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="form-group col-6">
                                <select name="intrested_course[]" data-placeholder="Please Select Intrested Course" class="form-control offerd_course mt-1 mt-2" multiple>
                                    @foreach ($campaign_course as $course)
                                        <option value="{{$course}}">{{$course}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-lg-12 justify-content-center align-center">
                            <button type="submit" title="Submit Your Message!" class="btn btn-submit" name="submit"
                                value="Submit">Submit</button>
                        </div>
                </div>
                </form>

            </div>
        </div>
        <div class="col-lg-5 col-md-4 d-flex align-items-center pl-5">
            <div class="login-right">


                <div class="login-right-list pt-4 ">
                    @if(isset($campaign))

                        {!! $campaign->description !!}
                    @endif

                </div>


            </div>
        </div>
    </div>
    </div>
@endsection

@section('page-specific-scripts')
    <script>
        $('.offerd_course').select2({
        });

        setTimeout(() => {
            $('#alert_message').hide();
        }, 6000);

        $('#enquiry_form').submit(function(){
            $(this).find(':input[type=submit]').prop('disabled', true);
        });
    </script>
@endsection
