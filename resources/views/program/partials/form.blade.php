@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
@csrf
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>

                <div class="card-body">
                    <div class="row">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#program" role="tab"
                                    aria-selected="true">Program Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#intake" role="tab"
                                    aria-selected="true">Intake</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#fee" role="tab"
                                    aria-selected="false">Fee Structure
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#eligibility" role="tab"
                                    aria-selected="false">Eligibility
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#criteria" role="tab"
                                    aria-selected="false">Criteria
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        @include('program.tab.program')
                        @include('program.tab.intake')
                        @include('program.tab.fee')
                        @include('program.tab.eligibility')
                        @include('program.tab.criteria')

                    </div>

                    <div class="form-group mb-0 row">
                        <div class="col-sm-12">
                            <input type="submit" value="Save" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@section('page-specific-scripts')
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
    <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script>
        $(function () {
            $('.ckeditor').each(function (e) {
            });
        });

        $('.offerd_course').select2({
            tags: true
        });

        $('.lfm').filemanager('file');
    </script>
@endsection
