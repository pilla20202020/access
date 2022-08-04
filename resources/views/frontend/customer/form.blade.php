@extends ('frontend.layouts.app')
@section('content')
    <div class="container login-section py-5">
        <div class="row gx-5">
            <div class="col-lg-7 col-md-8">
                <div class="login-form bg-light mt-4 p-4">
                    <img src="{{ asset('assets/images/access.png') }}" alt="" class="img-fluid">
                    <h5 class="login_welcome">Please register to continue. </h5>
                    <form method="POST" name="enq" action="{{ route('customerform.store') }}">
                        @csrf
                        <input type="hidden" name="campaign_id" id="" value="{{$campaign->id}}">
                        <div class="row">
                            <div class="form-group col-12">
                                <input required="required" placeholder="Enter Name" id="first-name" class="form-control"
                                    name="name" type="text">
                            </div>
                            <div class="form-group col-12">
                                <input required="required" placeholder="Enter Email" id="email" class="form-control"
                                    name="email" type="email">
                            </div>

                            <div class="form-group col-12">
                                <input required="required" placeholder="Enter Phone" id="phone" class="form-control"
                                    name="phone" type="number">
                            </div>
                        </div>


                        <div class="row">

                            <div class="form-group col-3">
                                <input required="required" placeholder="Enter Highest " class="form-control"
                                    name="highest_qualification" type="text">

                            </div>

                            <div class="form-group col-3">
                                <input required="required" placeholder="Enter Highest Grade" class="form-control"
                                    name="highest_grade" type="text">

                            </div>

                            <div class="form-group col-3">
                                <input required="required" placeholder="Enter Highest Stream" class="form-control"
                                    name="highest_stream" type="text">

                            </div>

                            <div class="form-group col-3">
                                <input required="required" placeholder="Enter Highest College" class="form-control"
                                    name="highest_college" type="text">
                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col-6">
                                <div class="form-group">
                                    <select name="test_name" class="form-control" id="test_name">
                                        <option value="" disabled selected>Select Language</option>
                                        <option value="ielts">Ielts</option>
                                        <option value="sat">SAT</option>
                                        <option value="gre">GRE</option>
                                        <option value="canada">Canada</option>
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
                                        <option selected disabled>Preferred Location</option>
                                        <option value="baneshowr">Baneshor</option>
                                                <option value="chitwan">Chitwan</option>
                                                <option value="pokhara">Pokhara</option>
                                                <option value="butwal">Butwal</option>

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
                    Accelerating your growth <br>
                    towards New Zealand.
                </h2>

                <div class="login-right-list pt-4 ">
                    <p class="login-list"><i class="fas fa-circle"></i><span class="list-para"> The
                            universities in New Zealand offer a world-class educational system.</span></p>
                    <p class="login-list"><i class="fas fa-circle"></i><span class="list-para">
                            Over 30,000 international students choose New Zealand as their study abroad destination
                            every year.span></p>
                    <p class="login-list"><i class="fas fa-circle"></i><span class="list-para"> The
                            fair allows students to gain all the essential knowledge about the entire application
                            process.</span></p>

                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
