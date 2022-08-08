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
                                <label for="name" class="col-form-label pt-0">Test Preparation Name</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="name"
                                        value="{{ old('name', isset($preparation->name) ? $preparation->name : '') }}"
                                        placeholder="Enter Test Preparation Name">
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 offset-lg-6 col-md-5 offset-md-4 col-12"> --}}

                            {{-- </div> --}}
                            <div class="form-group">
                                <label for="comment">Description:</label>
                                <textarea class="form-control" rows="5" id="description" name="description">
                                    @if (isset($preparation))
                                        {{ $preparation->description }}
                                    @endif
                                </textarea>
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
                            <a class="btn btn-light waves-effect ml-1" href="{{ route('preparation.index') }}">
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
