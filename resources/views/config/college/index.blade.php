@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}" />
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

@endsection

@section('title', 'College')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">List of all College</header>
                @if(Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success ml-auto">
                    {{Illuminate\Support\Facades\Session::get('success')}}
                </div>
                @endif
                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction btn-sm" href="{{route('colleges.create')}}">
                        <i class="md md-add"></i>
                        Add New
                    </a>
                </div>
            </div>
            <div class="card mt-2 p-4">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>S.No.</th>
                            <th>College Name</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('page-specific-scripts')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $(document).ready(function() {

            setTimeout(() => {
                $('#response_messsage').hide();
            }, 3000);

            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('colleges.data') }}',

                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: 'Export Search Results',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }],
                "columns": [{
                        "data": "id",
                        'visible': false
                    },
                    {
                        "data": "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "state"
                    },
                    {
                        "data": "country"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "actions",
                    },
                ],
                order: [
                    [1, 'desc']
                ]
            });
        });

        $(document).ready(function(){
            $(document).on('change','.status_switch',function(){
                var status = $(this).prop('checked') == true ? 1 : 0;
                var district_id = $(this).data('id');
                // alert(country_id);
                $.ajax({
                    type: "GET",
                    url: "{{route('colleges.change_status')}}",
                    data:{
                        'status': status,
                        'district_id': district_id
                    },
                    dataType: 'json',
                    success: function(response){

                    }
                });
             });
        });
    </script>
@endsection
