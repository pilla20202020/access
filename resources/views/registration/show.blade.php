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


                        </div>
                        <hr>

                        <h4>Qualification Detail: </h4>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Qualification:
                                    <span>{{ $registration->highest_qualification }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Grade: <span>{{ $registration->highest_grade }}</span></label>
                            </div>

                            <div class="col-md-3">
                                <label>Stream:
                                    <span>{{ $registration->highest_stream }}</span></label>
                            </div>

                        </div>
                        <hr>

                        <h4>Preparation Class Detail: </h4>
                        <div class="row">

                            <div class="col-md-6">
                                <label>Test Name: <span>{{ $registration->test_name }}</span></label>
                            </div>

                            <div class="col-md-6">
                                <label>Score: <span>{{ $registration->test_score }}</span></label>
                            </div>
                        </div>
                        <hr>
                        <h4>Intrested Course: </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Intrested Course: <span>{{ $registration->intrested_course }}</span></label>
                            </div>
                        </div>
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
