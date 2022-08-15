@extends('layouts.admin.admin')

@section('title', 'Create a Lead Category')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('leadcategory.store')}}" method="POST" novalidate>
            @include('leadcategory.form',['header' => 'Create a Lead Category'])
            </form>
        </div>
    </section>
@endsection

