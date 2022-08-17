@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862') }}" />
@endsection
@csrf
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-sm-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Location Name</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="name"
                                        value="{{ old('name', isset($location->name) ? $location->name : '') }}"
                                        placeholder="Enter Location Name">
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 offset-lg-6 col-md-5 offset-md-4 col-12"> --}}

                            {{-- </div> --}}
                            <div class="form-group">
                                <label for="name" class="col-form-label pt-0">Email</label>
                                <div class="">
                                    <input class="form-control" type="email" required name="email"
                                        value="{{ old('email', isset($location->email) ? $location->email : '') }}"
                                        placeholder="Enter Email">
                                </div>
                            </div>

                            @if(empty($location))
                                <div class="form-group">
                                    <label for="name" class="col-form-label pt-0">Password</label>
                                    <div class="">
                                        <input class="form-control" type="password" required name="password"
                                            value="{{ old('password') }}"
                                            placeholder="Enter Password">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="control-label">Desciption</label>
                                <textarea name="description" class="form-control" required>{{ old('description', isset($location->description) ? $location->description : '') }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row mt-2 justify-content-center">
                    <div class="form-group">
                        <div>
                            <a class="btn btn-light waves-effect ml-1" href="{{ route('location.index') }}">
                                <i class="md md-arrow-back"></i>
                                Back
                            </a>
                            <input type="submit" class="btn btn-danger waves-effect waves-light" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('page-specific-scripts')
@endsection
