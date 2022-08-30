@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}" />
@endsection

@section('title', 'Program')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Program</header>
                {{-- @can('jobtype-create') --}}
                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction btn-sm" href="{{ route('program.create') }}">
                        <i class="md md-add"></i>
                        + Add
                    </a>
                </div>
                {{-- @endcan --}}
            </div>
            <div class="d-flex">
                @if (session()->has('message'))
                    <div class="alert alert-success row" id="response_messsage">
                        {{ session()->get('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger" id="response_messsage">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="card mt-2 p-4">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Concact Person Name</th>
                            <th>Concact Email</th>
                            <th>Concact Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @each('program.partials.table', $programs, 'program')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('#response_messsage').hide();
            }, 3000);
        });

        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection
