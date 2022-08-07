@extends('layouts.admin.admin')
@section('title', 'Campaign')

@section('content')

<section>
    <div class="section-body">
        <form class="form form-validate floating-label" action="{{route('campaign.store')}}" method="POST" enctype="multipart/form-data" novalidate>
        @include('campaign.partials.form',['header' => 'Create a Campaign'])
        </form>
    </div>
</section>
@stop





