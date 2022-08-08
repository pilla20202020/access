@extends('layouts.admin.admin')

@section('title', 'Create a qualification')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('qualification.store')}}" method="POST" novalidate>
            @include('qualification.form',['header' => 'Create a job type'])
            </form>
        </div>
    </section>
@endsection

