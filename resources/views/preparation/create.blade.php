@extends('layouts.admin.admin')

@section('title', 'Create a Preparation')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('preparation.store')}}" method="POST" novalidate>
            @include('preparation.form',['header' => 'Create a Test Preparation'])
            </form>
        </div>
    </section>
@endsection

