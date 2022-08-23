@extends('layouts.admin.admin')

@section('title', 'Create a Admission')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('admission.store')}}" method="POST" enctype="multipart/form-data" >
            @include('admission.partials.form',['header' => 'Create a Admission'])
            </form>
        </div>
    </section>
@endsection

