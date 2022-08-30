@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
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
                        <div class="col-sm-6">
                            {{-- <div class="form-group">
                                <input type="text" name="name" class="form-control" required
                                       value="{{ old('name', isset($document_checklist->name) ? $document_checklist->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Name">Name</label>
                            </div> --}}
                            <label for="checklist_for" class="col-form-label pt-0">CheckList For</label>
                            <div class="form-group">
                                <select name="checklist_for" class="form-control">
                                    <option value="" disabled selected>Select Qualification</option>
                                    @foreach ($qualifications as $qualification)
                                        <option value="{{$qualification->name}}" @if(isset($document_checklist) && $document_checklist->checklist_for == $qualification->name) selected @endif>{{$qualification->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="checklist_name" class="col-form-label pt-0">CheckList Name</label>
                                <div class="">
                                    <input class="form-control" type="text" name="checklist_name" data-role="tagsinput"
                                    value="{{ old('checklist_name', isset($document_checklist->checklist_name) ? $document_checklist->checklist_name : '') }}" placeholder="Enter a CheckList Name" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr>
                    <h5>Add CheckList Item</h5>
                    <div id="additernary_edu">
                        @if(isset($document_checklist->checklists) && $document_checklist->checklists->isEmpty() == false)
                            @foreach ($document_checklist->checklists as $key => $checklist)
                            <input type="hidden" class="form-control" name="checklist_id[{{ $key }}]" value={{ $checklist->id }}>
                                <div class="form-group row d-flex align-items-end">.
                                    <div class="col-sm-4">
                                        <label class="control-label">Document Name</label>
                                        <input type="text" name="document_name[]" class="form-control" value="{{$checklist->document_name}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="hidden" name="document_sample[]" class="form-control" value="{{$checklist->document_sample}}" readonly>
                                        <a href="{{$checklist->document_sample}}" target="__blank">
                                            View Uploaded File
                                        </a>
                                    </div>

                                    <div class="col-md-2" style="margin-top: 45px;">
                                        <a href="{{route('document_checklist.delete_checklist',$checklist->id)}}" class="btn btn-sm btn-danger mr-1" type="submit" value="">Remove row</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group row d-flex align-items-end">.
                            <div class="col-sm-4 mb-2">
                                <label class="control-label">Document Name</label>
                                <input type="text" name="document_name[]" class="form-control" >
                            </div>

                            <div class="col-sm-6">
                                <label class="control-label">Document Name</label>
                                <div class="d-flex">
                                    <input id="thumbnail" class="form-control" type="text" name="document_sample[]" readonly>
                                    <button id="lfm" data-input="thumbnail" data-preview="holder" class="lfm btn btn-icon icon-left btn-primary ml-2 d-flex">
                                        <i class="fa fa-upload"></i> &nbsp;Choose
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-1" style="margin-top: 45px;">
                                <input id="additemrowedu" type="button" class="btn btn-sm btn-primary mr-1"
                                    value="Add Row">
                            </div>

                        </div>
                        <input type="hidden" id="tempedu" value="0" name="temp">
                    </div>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('document_checklist.index') }}">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


@section('page-specific-scripts')
    <script src="{{asset('resources/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });


        var append = 1;
        $(document).on('click', '#additemrowedu', function() {
            var b = parseFloat($("#tempedu").val());
            b = b + 1;
            $("#tempedu").val(b);
            var temp = $("#tempedu").val();
            var tst = `<div class="form-group row d-flex align-items-end appended-row-edu">

                <div class="col-sm-4 mb-2">
                    <label class="control-label">Document Name</label>
                    <input type="text" name="document_name[]" class="form-control">
                </div>

                <div class="col-sm-6">
                    <label class="control-label">Document Name</label>
                    <div class="d-flex">
                        <input id="thumbnail`+append+`" class="form-control" type="text" name="document_sample[]" readonly>
                        <button id="lfm`+append+`" data-input="thumbnail`+append+`" data-preview="holder`+append+`" class="lfm`+append+` btn btn-icon icon-left btn-primary ml-2 d-flex">
                            <i class="fa fa-upload"></i> &nbsp;Choose
                        </button>
                    </div>
                </div>


                <div class="col-md-2" style="margin-top: 45px;">
                    <input class="removeitemrowedu btn btn-sm btn-danger mr-1" type="button" value="Remove row">
                </div>

            </div>`
            $('#additernary_edu').append(tst);
            $('.lfm'+append).filemanager('file');
            append++;
            selectRefresh();
        });

        $(document).on('click', '.removeitemrowedu', function() {
            $(this).closest('.appended-row-edu').remove();
        })

        function remove_product(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

        function remove_productforedit(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

        $(document).ready(function() {
            $('.dropify').dropify();
        });

        $('.lfm').filemanager('file');
    </script>
@endsection
