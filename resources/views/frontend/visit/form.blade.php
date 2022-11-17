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
                    <form method="GET" id="enquiry_form" name="enq" action="{{ route('verify.validate') }}" class="p-3">
                        <div class="row">
                            <div class="form-group col-12">
                                <input required="required" placeholder="Enter Code" id="first-name" class="form-control"
                                    name="coupen_code" type="text">
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
