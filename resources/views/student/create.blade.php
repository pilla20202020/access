@extends('layouts.admin.admin')

@section('title', 'Create a Student')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{ route('student.store') }}" method="POST"
                enctype="multipart/form-data">
                @include('student.partials.form', ['header' => 'Create a Student'])
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        var provincesByCountryId = "{{ route('common.state.countryId') }}";
        var districtByProvinceId = "{{ route('common.district.provinceId') }}";
        $(document).ready(function() {
            // $('#country_id_dropdown').select2();
            $('#country_id').select2();
            $('#province_id').select2();
            $('#district_id').select2();
            $('#agent_id').select2();

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
                    $('.location').hide();

                } else if(value == 'location') {
                    $('.location').show();
                    $('.agent').hide();
                } else {
                    $('.agent').hide();
                    $('.location').hide();
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
                <select name="level[]" class="form-control">
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
                    class="form-control">
            </div>

            <div class="col-sm-2">
                <label class="control-label">Percentage</label>
                <input type="number" name="percentage[]"
                    class="form-control" min="0" max="100">
            </div>

            <div class="col-sm-3">
                <label class="control-label">Certification Upload</label>
                <input type="file" name="documents[]" class="form-control">
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
                <select name="language[]" class="form-control">
                    <option value="#" disabled selected>Select Language</option>
                    <option value="ielts">SLC/SEE</option>
                    <option value="sat">10+2 / A-Levels</option>
                    <option value="pte">Bachelors</option>
                    <option value="gre">Diploma</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="col-sm-2">
                <label class="control-label">Score</label>
                <input type="number" name="score[]"
                    class="form-control" min="0" max="100">
            </div>

            <div class="col-sm-3">
                <label class="control-label">Certification Upload</label>
                <input type="file" name="language_documents[]" class="form-control" >
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
