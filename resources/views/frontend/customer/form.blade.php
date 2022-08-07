@extends ('frontend.layouts.app')
@section('content')
    <div class="container login-section py-5">
        <div class="row gx-5">
            <div class="col-lg-7 col-md-8">
                <div class="login-form bg-light mt-4 p-4">
                    <img src="{{ asset('assets/images/access.png') }}" alt="" class="img-fluid">
                    @if(Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success">
                            {{Illuminate\Support\Facades\Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h5 class="login_welcome">Please register to continue. </h5>
                    <form method="POST" name="enq" action="{{ route('customerform.store') }}">
                        @csrf
                        <input type="hidden" name="campaign_id" id="" value="{{$campaign->id}}">
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
                                <input required="required" placeholder="Qualification " class="form-control"
                                    name="highest_qualification" type="text">

                            </div>

                            <div class="form-group col-4">
                                <input required="required" placeholder="Grade" class="form-control"
                                    name="highest_grade" type="text">

                            </div>

                            <div class="form-group col-4">
                                <input required="required" placeholder="Stream" class="form-control"
                                    name="highest_stream" type="text">

                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col-6">
                                <div class="form-group">
                                    <select name="test_name" class="form-control" id="test_name">
                                        <option value="" disabled selected>Test Preparation</option>
                                        <option value="ielts">IELTS</option>
                                        <option value="sat">SAT</option>
                                        <option value="gre">GRE</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group col-6">
                                <input required="required" placeholder="Enter Test Score " class="form-control"
                                    name="test_score" type="text">
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <div class="col-12">
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
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" title="Submit Your Message!" class="btn btn-default" name="submit"
                                value="Submit">Submit</button>
                        </div>
                </div>
                </form>

            </div>
        </div>
        <div class="col-lg-5 col-md-4 d-flex align-items-center pl-5">
            <div class="login-right">
                <h2 class="login-right-title ">
                    {{$campaign->name}}
                </h2>

                <div class="login-right-list pt-4 ">
                    @if(isset($campaign) && $campaign->banner)
                        <img class="img-fluid" src="{{ asset($campaign->thumbnail_path)}}"/>
                    @endif
                    {!! $campaign->description !!}

                </div>


            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
