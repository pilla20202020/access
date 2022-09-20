@extends('layouts.admin.admin')

@section('title', 'Create a Class')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('classes.store')}}" method="POST" enctype="multipart/form-data">
            @include('class.partials.form',['header' => 'Create a Class'])
            </form>
        </div>
    </section>
@endsection

