@extends('layouts.admin.admin')

@section('title', 'Create a Agent')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('agent.store')}}" method="POST" enctype="multipart/form-data">
            @include('agent.partials.form',['header' => 'Create a Agent'])
            </form>
        </div>
    </section>
@endsection

