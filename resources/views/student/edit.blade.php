@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('title',$student->name)

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('student.update',$student->id)}}"
                  method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('student.partials.form', ['header' => 'Edit student <span class="text-primary">('.($student->applicant).')</span>'])
            </form>
        </div>
    </section>

@endsection


@section('scripts')
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });

        var provincesByCountryId = "{{ route('common.state.countryId') }}";
        var districtByProvinceId = "{{ route('common.district.provinceId') }}";
        $(document).ready(function() {
            // $('#country_id_dropdown').select2();
            $('#country_id').select2();
            $('#province_id').select2();
            $('#district_id').select2();

            $('#marital_status').on('change', function() {
                var status = $(this).val();
                if (status == 'Yes') {
                    $('.spouse-name').show();
                } else {
                    $('.spouse-name').hide();
                }
            });

            $('#source_ref').on('change', function() {
                var value = $(this).val();
                if (value == 'agent') {
                    $('.agent').show();
                    $('.branch').hide();

                } else if(value == 'branch') {
                    $('.branch').show();
                    $('.agent').hide();
                } else {
                    $('.agent').hide();
                    $('.branch').hide();
                }
            });

            $('#has_experience_dropdown').on('change', function(e) {
                e.preventDefault();
                var has_experience = $(this).val();
                // alert(has_experience);
                if (has_experience == 'Yes') {
                    $('#experience_field').show();

                } else {
                    $('#experience_field').hide();
                }
            });
        });

        // For Education
        $(document).on('click', '#additemrow', function() {
            var b = parseFloat($("#temp").val());
            b = b + 1;
            $("#temp").val(b);
            var temp = $("#temp").val();
            var tst = `<div class="form-group row d-flex align-items-end appended-row">
            <div class="col-sm-3">
                <input type="hidden" class="form-control" name="candidate_id">
                <label class="control-label">Level</label>
                <select name="level[]" class="form-control" required>
                    <option value="#" disabled selected>Select Education</option>
                    <option value="slc">SLC/SEE</option>
                    <option value="highschool">10+2 / A-Levels</option>
                    <option value="bachelor">Bachelors</option>
                    <option value="diploma">Diploma</option>
                    <option value="masters">Masters</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="col-sm-3">
                <label class="control-label">Institute / University</label>
                <input type="text" name="university[]"
                    class="form-control" required>
            </div>

            <div class="col-sm-2">
                <label class="control-label">Percentage</label>
                <input type="number" name="percentage[]"
                    class="form-control" min="0" max="100" required>
            </div>

            <div class="col-sm-3">
                <label class="control-label">Certification Upload</label>
                <input type="file" name="documents[]" class="form-control" required>
            </div>

            <div class="col-md-1" style="margin-top: 45px;">
                <input class="removeitemrow btn btn-sm btn-danger mr-1" type="button" value="Remove row">
            </div>

        </div>`

            $('#additernary').append(tst);
            selectRefresh();
        });

        $(document).on('click', '.removeitemrow', function() {
            $(this).closest('.appended-row').remove();
        })

        function remove_product(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

        function remove_productforedit(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }


        // For Language
        $(document).on('click', '#lang_additemrow', function() {
            var b = parseFloat($("#lang_temp").val());
            b = b + 1;
            $("#temp").val(b);
            var temp = $("#temp").val();
            var tst = `<div class="form-group row d-flex align-items-end languageappended-row">
            <div class="col-sm-3">
                <input type="hidden" class="form-control" name="candidate_id">
                <label class="control-label">Language</label>
                <select name="language[]" class="form-control" required>
                    <option value="#" disabled selected>Select Language</option>
                    <option value="ielts">Itelts</option>
                    <option value="sat">SAT</option>
                    <option value="pte">PTE</option>
                    <option value="gre">GRE</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="col-sm-2">
                <label class="control-label">Score</label>
                <input type="number" name="score[]"
                    class="form-control" min="0" max="100" required>
            </div>

            <div class="col-sm-3">
                <label class="control-label">Certification Upload</label>
                <input type="file" name="language_documents[]" class="form-control" required>
            </div>

            <div class="col-md-1" style="margin-top: 45px;">
                <input class="langremoveitemrow btn btn-sm btn-danger mr-1" type="button" value="Remove row">
            </div>

        </div>`

            $('#language').append(tst);
            selectRefresh();
        });

        $(document).on('click', '.langremoveitemrow', function() {
            $(this).closest('.languageappended-row').remove();
        })

        function remove_product(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

        function remove_productforedit(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }
    </script>
    <script src="{{ asset('js/student/student.js') }}"></script>
@endsection

