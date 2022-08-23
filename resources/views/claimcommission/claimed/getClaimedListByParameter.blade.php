@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Claimed Commission List')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Claimed Commission List</header>
            </div>
            <div class="card mt-2 p-4">
                <form method="get" action="{{route('commission-claim.get_claimed_commission_by_parameter')}}">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="country" class="form-label">Country</label>
                                <select name="country_id" id="country_dropdown" class="form-control" required >
                                    <option value="#" selected disabled>Choose country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}" @if(old('country_id') == $country->id) selected @endif @if(isset($filters) && ($filters['country_id'] == $country->id)) selected @endif>{{$country->country_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="country" class="form-label">State</label>
                                <select name="state_id" id="state_dropdown" class="form-control" required>
                                    @if(isset($filters))
                                        <option value="#" selected disabled>Select State</option>
                                        @foreach ($states as $state)
                                            @if($state->country_id == $filters['country_id'])
                                                <option value="{{$state->id}}" @if(old('state_id') == $state->id) selected @endif @if(isset($filters) && ($filters['state_id'] == $state->id)) selected @endif>{{$state->state_name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="college_id" class="col-form-label pt-0">Select College</label>
                                <div class="">
                                    <select data-placeholder="Select College"
                                        class="tail-select form-control college_class" id="college_id"
                                        name="college_id" >
                                        <option value="" selected disabled>Select College</option>
                                        @if(isset($filters))
                                            @foreach ($colleges as $college)
                                                @if($college->state_id == $filters['state_id'])
                                                    <option value="{{$college->id}}" @if(old('college_id') == $college->id) selected @endif @if(isset($filters) && ($filters['college_id'] == $college->id)) selected @endif>{{$college->name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 tools">
                            <input type="submit" class="btn btn-primary ink-reaction mt-4">
                                <i class="md md-add"></i>
                            </a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="example" class="table table-hover display">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Student</th>
                            <th>College</th>
                            <th>Commission Date</th>
                            <th>Program</th>
                            <th>Commission Price</th>
                            <th>Commission Claim Date</th>
                            <th>Status</th>
                            <th>Add Follow Up</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($commissions as $key => $commission)
                            @if($commission->admission->college->country_id == $filters['country_id'] && $filters['state_id'] == null && $filters['college_id'] == null)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{ Str::limit($commission->student->name, 47) }}</td>
                                    <td>{{ Str::limit($commission->admission->college->name, 47) }}</td>
                                    <td>{{ $commission->claim_date }}</td>
                                    <td>{{ Str::limit($commission->student->program, 47) }}</td>
                                    <td>{{ $commission->fees }}</td>
                                    <td>
                                        @if(isset($commission->claimCommission))
                                            {{ $commission->claimCommission->commission_claim_date }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class='badge badge-success p-1'>Paid</span>
                                    </td>
                                    <td>
                                        <a href="javascript: void(0);" data-commission_id="{{$commission->commissions_id}}"  class="btn btn-secondary btn-sm mr-1 p-1 ml-2 addfollowup" title="Add Follow Up">
                                            Add Follow Up
                                        </a>
                                    </td>


                                </tr>
                            @elseif($commission->admission->college->country_id == $filters['country_id'] && $commission->admission->college->state_id == $filters['state_id'] && $filters['college_id'] == null)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{ Str::limit($commission->student->name, 47) }}</td>
                                    <td>{{ Str::limit($commission->admission->college->name, 47) }}</td>
                                    <td>{{ $commission->claim_date }}</td>
                                    <td>{{ Str::limit($commission->student->program, 47) }}</td>
                                    <td>{{ $commission->fees }}</td>
                                    <td>
                                        @if(isset($commission->claimCommission))
                                            {{ $commission->claimCommission->commission_claim_date }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class='badge badge-success p-1'>Paid</span>
                                    </td>
                                    <td>
                                        <a href="javascript: void(0);" data-commission_id="{{$commission->commissions_id}}"  class="btn btn-secondary btn-sm mr-1 p-1 ml-2 addfollowup" title="Add Follow Up">
                                            Add Follow Up
                                        </a>
                                    </td>


                                </tr>
                            @elseif($commission->admission->college->country_id == $filters['country_id'] && $commission->admission->college->state_id == $filters['state_id'] && $commission->admission->college->college_id == $filters['college_id'])
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{ Str::limit($commission->student->name, 47) }}</td>
                                    <td>{{ Str::limit($commission->admission->college->name, 47) }}</td>
                                    <td>{{ $commission->claim_date }}</td>
                                    <td>{{ Str::limit($commission->student->program, 47) }}</td>
                                    <td>{{ $commission->fees }}</td>
                                    <td>
                                        @if(isset($commission->claimCommission))
                                            {{ $commission->claimCommission->commission_claim_date }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class='badge badge-success p-1'>Paid</span>
                                    </td>
                                    <td>
                                        <a href="javascript: void(0);" data-commission_id="{{$commission->commissions_id}}"  class="btn btn-secondary btn-sm mr-1 p-1 ml-2 addfollowup" title="Add Follow Up">
                                            Add Follow Up
                                        </a>
                                    </td>


                                </tr>
                            @endif
                            @endforeach
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
                    <form action="{{route('admission.addfollowup')}}" method="POST" class="form form-validate floating-label">
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
                                        <option value="claim_commission">Claim Commission</option>
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
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#example').DataTable();
        });

        $(document).on('click','.addfollowup',function (e) {
            let commission_id = $(this).data('commission_id');
            $(".change_claim_commission").val(commission_id);
            $('.add_followup').modal('show');

        });




    </script>

    <script>
        $(document).ready(function(){
            $('#country_dropdown').select2();
            $('#state_dropdown').select2();
            $('#college_id').select2();


            $('#country_dropdown').on('change',function(e){
            e.preventDefault();
            var country_id = $(this).val();
            // alert(country_id);
                $.ajax({
                    type: "GET",
                    url: "{{route('colleges.get_states')}}",
                    data: {
                        'country_id': country_id
                    },
                    dataType: "json",
                    success: function(response){
                        // console.log(response);
                        $('#state_dropdown').html('<option value="#" selected disabled>Choose State</option>');
                        $.each(response.message, function(key,value){
                            $('#state_dropdown').append('<option value='+value.id+'>'+value.state_name+'</option>');
                        });
                    }
                });
            });

            $('#state_dropdown').on('change', function(e) {
                e.preventDefault();
                var state_id = $(this).val();
                var body = "";
                $.ajax({
                    type: 'POST',
                    url: "{{route('common.college.provinceId')}}",
                    data: {
                        _token: $("meta[name='csrf-token']").attr('content'),
                        state_id: state_id,
                    },
                    success: function(response) {
                        $('#college_id').html('');
                        body = '<option value="" selected disabled>Select College</option>';
                        if (response.colleges) {
                            $.each(response.colleges, function(key, college) {
                                body += "<option value='" + college['id'] + "'>" + college['name'] + "</option>";
                            });
                            $('#college_id').html(body);
                        }
                    }
                })
            })
        });
    </script>


@endsection


