@extends('layouts.admin.admin')

@section('title', 'Edit State')

@section('content')
    <section>
        <div class="section-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-head">
                                    <header class="ml-3 mt-2">Edit State(Province)</header>
                                    <a href="{{route('states.index')}}" class="btn btn-secondary" style="float: right;">Go Back</a>
                                </div>
                                <form class="form form-validate floating-label" action="{{route('states.update',$state->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name" class="form-label">State Name</label>
                                                    <input type="text" class="form-control" name="state_name" value={{$state->state_name}}>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="country" class="form-label">Country</label>
                                                    <select name="country_id" id="country_dropdown" class="form-control">
                                                        @foreach ($countries as $country)
                                                            <option value="{{$country->id}}" @if($state->country_id == $country->id) selected @endif>{{$country->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select name="status" id="status_dropdowns" class="form-control">
                                                        <option value="Active" @if($state->status == 'Active') selected @endif>Active</option>
                                                        <option value="Inactive" @if($state->status == 'Inactive') selected @endif>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary ml-2">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
      <script>
          $(document).ready(function(){
              $('#country_dropdown').select2();
          })
      </script>
@endsection
