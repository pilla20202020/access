@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}" />
@endsection

@section('title', 'Registration')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Registration Lists</header>
            </div>
            <div class="card mt-2 p-4">
                <div class="table-responsive">

                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @each('registration.partials.table', $registrations, 'registration')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Follow Up Modal --}}
    <div class="modal fade add_followup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('registration.addfollowup') }}" method="POST"
                        class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="registration_id" value="" name="refrence_id"
                            id="">
                        <input type="hidden" class="follow_up_type" value="registration" name="follow_up_type"
                            id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Follow Up To</label>
                                <input type="text" name="follow_up_name" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Remarks</label>
                                <textarea name="remarks" class="form-control" required></textarea>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Next Schedule</label>
                                <input type="date" name="next_schedule" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Follow Up By</label>
                                <input type="text" name="follow_up_by" class="form-control" required>
                            </div>

                            @if (isset($leadCategories))
                                <div class="col-md-12 mt-2">
                                    <label for="Name">Follow Up Option</label>
                                    <select name="leadcategory_id" class="form-control">
                                        @foreach ($leadCategories as $category)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span
                                        class="text-danger">{{ $errors->has('leadcategory_id') ? $errors->first('leadcategory_id') : '' }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <h6>Previous List of Follow Ups</h6>
                        <thead class="thead-light">
                            <tr>
                                <th>S.No.</th>
                                <th>Follow Up By</th>
                                <th>Next Schedule</th>
                                <th>Remarks</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                        </thead>
                        <tbody id="followuplist">

                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- Add SMS --}}
    <div class="modal fade send_sms" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('registration.send_sms') }}" method="POST"
                        class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="registration_id" value="" name="registration_id"
                            id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">From</label>
                                <input type="text" name="from" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Message</label>
                                <textarea name="message" class="form-control" required></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@stop


@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

        $(document).on('click', '.addfollowup', function(e) {
            let registration_id = $(this).data('registration_id');
            $(".registration_id").val(registration_id);
            $.ajax({
                type: 'get',
                url: '{{ route('registration.viewfollowup') }}',
                data: {
                    registration_id: registration_id,
                },
                success: function(response) {
                    if (typeof(response) != 'object') {
                        response = JSON.parse(response)
                    }
                    var tbody_html = "";
                    if (response.status) {
                        $.each(response.data, function(key, followup) {
                            key = key + 1;
                            tbody_html += "<tr>";
                            tbody_html += "<td>" + key + "</td>";
                            tbody_html += "<td>" + followup.follow_up_by + "</td>";
                            tbody_html += "<td>" + followup.next_schedule + "</td>";
                            tbody_html += "<td>" + followup.remarks + "</td>";
                            tbody_html += "</tr>";
                        });
                        $('#followuplist').html(tbody_html);
                        $('.add_followup').modal('show');
                    }
                }

            })

        });

        $(document).on('click', '.sendsms', function(e) {
            let registration_id = $(this).data('registration_id');
            $(".registration_id").val(registration_id);
            $('.send_sms').modal('show');
        });

        $('.leadcategory').select2();
    </script>
@endsection
