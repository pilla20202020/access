@extends('backend.layouts.admin.admin')
@section('title', 'campaign')

@section('content')
<section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('campaign.store')}}" method="POST" enctype="multipart/form-data" novalidate>
            @include('backend.campaign.partials.form',['header' => 'Create a campaign'])
            </form>
        </div>
    </section>
@stop


@push('styles')
    <link href="{{ asset('backend/assets/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('backend/assets/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/libs/dropify/dropify.min.js') }}"></script>
@endpush
