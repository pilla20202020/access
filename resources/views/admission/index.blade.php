@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Admission List')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">admission List</header>
                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction" href="{{ route('admission.create') }}">
                        <i class="md md-add"></i>
                        Add admission
                    </a>
                </div>
            </div>
            <div class="card mt-2 p-4">
                <div class="table-responsive">
                    <table id="example" class="table table-hover display">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Student</th>
                            <th>Country/State</th>
                            <th>College</th>
                            <th>Intake</th>
                            <th>Program</th>
                            <th>Fee</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @each('admission.partials.table', $admissions, 'admission')
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- View Payment Modal --}}
    <div class="modal fade paymentmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">View Payment History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Fees</th>
                                <th>Claim Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="studentadmission">

                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- Change Commission Status Modal --}}
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Claim Commission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admission.addcommissionclaim')}}" method="POST" class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="change_status_commission" value="" name="commission_id" id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Upcoming Pending Commission: <span class="modal_upcoming_title"></span> (<span class="modal_upcoming_date"></span>)</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Receipt To</label>
                                <input type="text" name="client_name" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Commission Claim Date</label>
                                <input type="date" name="commission_claim_date" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Remarks</label>
                                <textarea name="claim_remarks" class="form-control" required></textarea>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Status</label>
                                <div class="">
                                    <select data-placeholder="Select Status"
                                        class="select2 tail-select form-control " id="mydropdownlist"
                                        name="commissions_claim_status" required>
                                        <option value="" selected disabled >Select Status</option>
                                        <option value="paid" >Paid</option>
                                        <option value="defer" >Defer</option>

                                    </select>

                                </div>
                            </div>

                            <div class="col-md-12 mt-2 deferdate d-none">
                                <label class="control-label">Defer Commission Date</label>
                                <input type="date" name="defer_date" class="form-control defer_date" value="">
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

    {{-- Add Commencement Modal --}}
    <div class="modal fade addcommencementmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Add Commencement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admission.addcommencement')}}" method="GET" class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="add_commencement_id" value="" name="admission_id" id="">
                        <input type="hidden" class="student_commencement" value="" name="student_id" id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Commencement Date</label>
                                <input type="date" name="commenced_date" class="form-control" required>
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
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#example').DataTable();
        });

        $(document).on('click','.viewhistory',function (e) {
            let admission_id = $(this).data('admission_id');
            $.ajax({
                type: 'get',
                url: '{{route('admission.getcommissiondetail')}}',
                data: {
                    admission_id: admission_id,
                },
                success:function(response){
                if(typeof(response) != 'object'){
                    response = JSON.parse(response)
                }
                var tbody_html = "";
                if(response.status){
                    $.each(response.data, function(key, commission_detail){
                        key = key+1;
                        tbody_html += "<tr>";
                        tbody_html += "<td>"+key+"</td>";
                        tbody_html += "<td>"+commission_detail.title+"</td>";
                        tbody_html += "<td>"+commission_detail.fees+"</td>";
                        tbody_html += "<td>"+commission_detail.claim_date+"</td>";
                        if(commission_detail.commissions_status == "pending") {
                            tbody_html += "<td><span class='badge badge-danger p-2'>Pending</span></td>";
                        } else {
                            tbody_html += "<td><span class='badge badge-success p-2'>Paid</span></td>";
                        }
                        tbody_html += "</tr>";
                    });
                    $('#studentadmission').html(tbody_html);
                    $('.paymentmodal').modal('show');
                }
            }

            })
        });

        $(document).on('click','.changestatus',function (e) {
            var commission_id = $(this).data('commission_id');
            var upcoming_commission_date = $(this).next('.upcoming_commission_date').val();
            var upcoming_commission_title = $(this).next().next('.upcoming_commission_title').val();
            $(".modal_upcoming_date").text(upcoming_commission_date);
            $(".modal_upcoming_title").text(upcoming_commission_title);
            $(".change_status_commission").val(commission_id);
            $('.bs-example-modal-center').modal('show');
        });

        $(document).on('change','#mydropdownlist',function (e) {
            if($(this).val() == "defer") {
                $('.deferdate').removeClass('d-none');
                $(".deferdate").show().find("input").prop("required", true);
            } else {
                $('.deferdate').addClass('d-none');
                $(".deferdate").show().find("input").prop("required", false);
                $('.defer_date').val(null);
            }
        })

        $(document).on('click','.addcommencement',function (e) {
            var admission_id = $(this).data('admission_id');
            var student_id = $(this).next('.student_id').val();
            $(".add_commencement_id").val(admission_id);
            $(".student_commencement").val(student_id);

            $('.addcommencementmodal').modal('show');

        });


    </script>


@endsection


