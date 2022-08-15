@extends('layouts.admin.admin')

@section('title', 'Create a Location')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('location.store')}}" method="POST" novalidate>
            @include('location.form',['header' => 'Create a Location'])
            </form>
        </div>
    </section>
@endsection

