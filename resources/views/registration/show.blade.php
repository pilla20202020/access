@extends('layouts.admin.admin')

@section('title', 'Registration')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Registration Lists</header>
            </div>
            <div class="card mt-2 p-4">
                <div class="card-body p-5">
                    <div class="container">
                        <h4>Student Detail: </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Student Name: <span>{{ $registration->name }}</span></label>
                            </div>

                            <div class="col-md-4">
                                <label>Email: <span>{{ $registration->email }}</span></label>
                            </div>

                            <div class="col-md-4">
                                <label>Phone: <span>{{ $registration->phone }}</span></label>
                            </div>

                            <div class="col-md-4 mt-1">
                                <label>Intrested Country: <span>{{ $registration->intrested_for_country }}</span></label>
                            </div>

                            <div class="col-md-4">
                                <label>Intrested Course: <span>{{ $registration->interested_course }}</span></label>
                            </div>

                            <div class="col-md-4">
                                <label>Preffered Location: <span>{{ $registration->preffered_location }}</span></label>
                            </div>
                        </div>
                        <hr>
                        <h4>Address: </h4>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Zone: <span>{{ $registration->zone }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>State: <span>{{ $registration->state }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>City: <span>{{ $registration->city }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Address: <span>{{ $registration->address }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Nearest landmark: <span>{{ $registration->nearest_landmark }}</span></label>
                            </div>
                        </div>
                        <hr>
                        <h4>SEE Detail: </h4>
                        <div class="row">
                            <div class="col-md-3">
                                <label>SEE Year: <span>{{ $registration->see_year }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>SEE Grade: <span>{{ $registration->see_grade }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>SEE Stream: <span>{{ $registration->see_stream }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>SEE School: <span>{{ $registration->see_school }}</span></label>
                            </div>
                        </div>
                        <hr>

                        <h4>+2 Detail: </h4>
                        <div class="row">
                            <div class="col-md-3">
                                <label>+2 Year: <span>{{ $registration->plus2_year }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>+2 Grade: <span>{{ $registration->plus2_grade }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>+2 Stream: <span>{{ $registration->plus2_stream }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>+2 College: <span>{{ $registration->plus2_college }}</span></label>
                            </div>
                        </div>
                        <hr>

                        <h4>Bachelor Detail: </h4>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Bachelor Year: <span>{{ $registration->bachelors_year }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Bachelor Grade: <span>{{ $registration->bachelors_grade }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Bachelor Stream: <span>{{ $registration->bachelors_stream }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Bachelor College: <span>{{ $registration->bachelors_college }}</span></label>
                            </div>
                        </div>
                        <hr>

                        <h4>Highest Qualification Detail: </h4>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Highest Qualification Year:
                                    <span>{{ $registration->highest_qualification }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Highest Qualification Grade: <span>{{ $registration->highest_grade }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Highest Qualification Stream:
                                    <span>{{ $registration->highest_stream }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Highest Qualification College:
                                    <span>{{ $registration->highest_college }}</span></label>
                            </div>
                        </div>
                        <hr>

                        <h4>Preparation Class Detail: </h4>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Preparation Class Year: <span>{{ $registration->preparation_class }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Preparation Class Score: <span>{{ $registration->preparation_score }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>BandScore: <span>{{ $registration->preparation_bandscore }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Date: <span>{{ $registration->preparation_date }}</span></label>
                            </div>

                            <div class="col-md-6">
                                <label>Test Name: <span>{{ $registration->test_name }}</span></label>
                            </div>

                            <div class="col-md-6">
                                <label>Test Score: <span>{{ $registration->test_score }}</span></label>
                            </div>
                        </div>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('styles')
    <style type="text/css">
        #accordion .card-head {
            cursor: n-resize;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('backend/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('backend/js/libs/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
