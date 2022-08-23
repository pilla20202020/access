@extends('layouts.admin.admin')

@section('title', 'Add a New City')

@section('content')
    <section>
        <div class="section-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-head">
                                    <header class="ml-3 mt-2">Add a New College</header>
                                    <a href="{{route('colleges.index')}}" class="btn btn-secondary" style="float: right;">Go Back</a>
                                </div>
                                <form class="form form-validate floating-label" action="{{route('colleges.update',$college->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="name" class="form-label">District Name</label>
                                                    <input type="text" class="form-control" name="name" value={{$college->name}}>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="country" class="form-label">Country</label>
                                                    <select name="country_id" id="country_dropdown" class="form-control" required>
                                                        @foreach ($countries as $country)
                                                            <option value="{{$country->id}}" @if($college->country_id == $country->id) selected @endif>{{$country->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="country" class="form-label">State (Province)</label>
                                                    @if($college->state_id)
                                                    <select name="state_id" id="state_dropdown" class="form-control" required>
                                                        <option value="{{$state->id}}">{{$state->state_name}}</option>
                                                    </select>
                                                    @else
                                                    <select name="state_id" id="state_dropdown" class="form-control" required>

                                                    </select>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select name="status" id="status_dropdowns" class="form-control">
                                                        <option value="Active" @if($college->status == 'Active') selected @endif>Active</option>
                                                        <option value="Inactive"  @if($college->status == 'Inactive') selected @endif>Inactive</option>
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
              $('#state_dropdown').select2();

              $('#country_dropdown').on('change',function(e){
                e.preventDefault();
                var country_id = $(this).val();
                // alert(country_id);
                $.ajax({
                    type: "GET",
                    url: "{{route('colleges.get_states')}}",
                    data: {
                        'country_id': country_id
                    },
                    dataType: "json",
                    success: function(response){
                        // console.log(response);
                        $('#state_dropdown').html('<option value="#" selected disabled>Choose State</option>');
                        $.each(response.message, function(key,value){
                            $('#state_dropdown').append('<option value='+value.id+'>'+value.state_name+'</option>');
                        });
                    }
                });
              });
          });
      </script>
@endsection
