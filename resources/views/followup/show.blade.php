@extends('layouts.admin.admin')

@section('title', 'Followup')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Follow Ups</header>
                <div class="form-group ml-auto">
                    <div>
                        <a class="btn btn-light waves-effect ml-1" href="{{ route('followup.index') }}">
                            <i class="md md-arrow-back"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mt-2 p-4">
                <div class="card-body p-5">
                    <div class="container">
                        <h4>Student Detail: </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Student Name: <span>{{ $followup->registration($followup->id)->name }}</span></label>
                            </div>

                            <div class="col-md-4">
                                <label>Email: <span>{{ $followup->registration($followup->id)->email }}</span></label>
                            </div>

                            <div class="col-md-4">
                                <label>Phone: <span>{{ $followup->registration($followup->id)->phone }}</span></label>
                            </div>


                        </div>
                        <hr>
                        <h4>Follow Up Details: </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Folllow Up By: <span>{{ $followup->follow_up_by }}</span></label>
                            </div>

                            <div class="col-md-4">
                                <label>Next Schedule: <span>{{ $followup->next_schedule }}</span></label>
                            </div>

                            <div class="col-md-4">
                                <label>Remarks: <span>{{ $followup->remarks }}</span></label>
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
