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

                        <div class="col-lg-6">
                            <img src="{{asset('images/access.png')}}" alt="" class="img-fluid" width="150">
                        </div>

                        <div class="col-lg-6  align-self-center">
                            <div class="">
                                <div class="float-right">
                                    <h6 class="mb-0"><b>Applicane Name : {{ $admission->student->applicant }}</b> </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-left mt-5">
                                <address class="font-13">
                                    <strong class="font-size-14">Applicant Detail :</strong><br>
                                    <h6 class="mb-2 mt-1"><b>Applicant Name :</b> {{ $admission->student->first_name }} {{ $admission->student->middle_name }}
                                        {{ $admission->student->last_name }}</h6>
                                    <h6 class="mb-2"><b>Country :</b> {{$admission->student->student_country->country_name}}</h6>
                                    <h6 class="mb-2"><b>State :</b>{{$admission->student->student_state->state_name}}</h6>
                                    <h6 class="mb-2"><b>District :</b>{{$admission->student->student_district->district_name}}</h6>
                                    <h6 class="mb-2"><b>Contact no. :</b>{{$admission->student->mobile_no}}</h6>
                                </address>
                            </div>
                            <div class="float-right text-right mt-5">
                                <address class="font-13">
                                    <h6 class="mb-2"><b>Country :</b> {{ $admission->country->country_name }}</h6>
                                    <h6 class="mb-2"><b>State :</b> {{ $admission->state->state_name }}</h6>
                                    <h6 class="mb-2">College/Uni :</strong> {{$admission->college->name}}<br>
                                    <h6 class="mb-2"><b>Commenced Date :</b> {{ $admission->commenced_date }}</h6>
                                    <h6 class="mb-2"><b>Intake Date :</b> {{ ucfirst($admission->intake_month) }},{{$admission->intake_year}}</h6>

                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 d-flex justify-content-center">
                        <div class="col-md-12 ml-auto">
                            <div class="text-center"><h4>Commission Lists</h4></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Commission Name</th>
                                            <th>Commission Amount</th>
                                            <th>Commission Claimed Date</th>
                                            <th>Commissions Claim Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($admission->commissions) && $admission->commissions->isEmpty() == false)
                                            @foreach ($admission->commissions as $commission)
                                                <tr>
                                                    <th>{{$loop->index+1}}</th>
                                                    <td>{{$commission->title}}</td>
                                                    <td>{{$commission->fees}}</td>
                                                    <td>
                                                        @if(isset($commission->claimCommission))
                                                            {{$commission->claimCommission->commission_claim_date}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($commission->claimCommission))
                                                            {{ucfirst($commission->claimCommission->commissions_claim_status)}}
                                                        @else
                                                            Pending
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h5 class="mt-4">Terms And Condition :</h5>
                            <ul class="pl-3">
                                <li><small>To be paid by cheque or credit card or direct payment online.</small></li>
                                <li><small> If account is not paid within 7 days the credits details supplied as confirmation<br> of work undertaken will be charged the agreed quoted fee noted above.</small></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 align-self-end">
                            <div class="w-25 float-right">
                                <img src="assets/images/signature.png" alt="" class="img-fluid">
                                <p class="border-top">Signature</p>
                            </div>
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


