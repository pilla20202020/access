@extends('layouts.admin.admin')

@section('title', 'Create a Document Checklist')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('document_checklist.store')}}" method="POST" enctype="multipart/form-data">
            @include('documents_checklist.partials.form',['header' => 'Create a Document Checklist'])
            </form>
        </div>
    </section>
@endsection

