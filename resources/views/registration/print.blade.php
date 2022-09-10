@extends('layouts.admin.admin')
@section('title', 'Generate Invoice')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12 col-lg-10 mx-auto">
            <div class="card">
                <div class="col-md-12 pt-3">
                    <div class="float-right d-print-none">
                        <a href="javascript:window.print()" class="btn btn-info"><i class="fa fa-print"></i></a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-left">
                                <img src="{{setting('image')}}" alt="" class="img-fluid" width="200">
                            </div>

                            <div class="float-right mt-5">
                                <h3 class="pt-2">Counselling Form : {{$registration->coupen_code}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        

                        <div class="col-lg-12 mt-2">
                            <h5>Name: {{$registration->name}}</h5>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <h5>Email: {{$registration->email}}</h5>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <h5>Mobile: {{$registration->phone}}</h5>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <h5>Highest Qualification: {{$registration->highest_qualification}}</h5>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <h5>Highest Grade: {{$registration->highest_grade}}</h5>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <h5>Highest Stream: {{$registration->highest_stream}}</h5>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <div class="float-left">
                                <h5>Test Preparation: {{$registration->test_name}}</h5>
                            </div>
                            <div class="float-right">
                                <h5>Test Score: {{$registration->test_score}}</h5>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <h5>Remarks:</h5>
                            <textarea cols="60" rows="15">{{$registration->remarks}}</textarea>
                        </div>

                        
                    </div>
                    
                    <hr>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 ml-auto align-self-center">
                            <div class="text-center text-muted"><small>Thank you very much for doing business with us. Thanks !</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


