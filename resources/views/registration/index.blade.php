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
    <div class="modal fade add_followup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('registration.addfollowup')}}" method="POST" class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="change_claim_commission" value="" name="refrence_id" id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Follow Up To</label>
                                <input type="text" name="follow_up_name" class="form-control" required>
                            </div>


                            <div class="col-md-12 mt-2">
                                <label class="control-label">Follow Up Type</label>
                                    <select data-placeholder="Select Status"
                                        class="select2 tail-select form-control " id=""
                                        name="follow_up_type" required>
                                        <option value="" selected disabled >Select Follow Up Type</option>
                                        <option value="registration">Registration</option>
                                    </select>
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
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
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

        $(document).on('click','.addfollowup',function (e) {
            let commission_id = $(this).data('commission_id');
            $(".change_claim_commission").val(commission_id);
            $('.add_followup').modal('show');

        });
    </script>
@endsection
