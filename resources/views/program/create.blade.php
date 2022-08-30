@extends('layouts.admin.admin')

@section('title', 'Create a Program')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{ route('program.store') }}" method="POST" novalidate>
                @include('program.partials.form', ['header' => 'Create a Program'])
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // For Intake
        $(document).on('click', '#additemrow', function() {
            var b = parseFloat($("#temp").val());
            b = b + 1;
            $("#temp").val(b);
            var temp = $("#temp").val();
            var tst = `<div class="form-group row d-flex align-items-end appended-row">
            <div class="col-sm-2">
                <label class="control-label">Title</label>
                <input type="text" class="form-control" name="intake_title[]" required>
            </div>

            <div class="col-sm-2">
                <label class="control-label">Intake Dates</label>
                <input type="date" class="form-control" name="intake_date[]" required>
            </div>

            <div class="col-sm-2">
                <label class="control-label">Class Commencement</label>
                <input type="date" name="class_commencement[]" class="form-control">
            </div>

            <div class="col-sm-2">
                <label class="control-label">Deadline Date</label>
                <input type="date" name="deadline_date[]" class="form-control" required>
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


        // For Fee
        $(document).on('click', '#fee_additemrow', function() {
            var b = parseFloat($("#fee_temp").val());
            b = b + 1;
            $("#temp").val(b);
            var temp = $("#temp").val();
            var tst = `<div class="form-group row d-flex align-items-end feeappended-row">
                <div class="col-sm-3">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control" name="fee_title[]" required>
                </div>

                <div class="col-sm-3">
                    <label class="control-label">Type</label>
                    <input type="text" class="form-control" name="fee_type[]" required>
                </div>

                <div class="col-sm-3">
                    <label class="control-label">Amount</label>
                    <input type="text" name="fee_amount[]" class="form-control">
                </div>

            <div class="col-md-1" style="margin-top: 45px;">
                <input class="feeremoveitemrow btn btn-sm btn-danger mr-1" type="button" value="Remove row">
            </div>

        </div>`

            $('#fee').append(tst);
            selectRefresh();
        });

        $(document).on('click', '.feeremoveitemrow', function() {
            $(this).closest('.feeappended-row').remove();
        })

        // For Criteria
        $(document).on('click', '#criteria_additemrow', function() {
            var b = parseFloat($("#criteria_temp").val());
            b = b + 1;
            $("#temp").val(b);
            var temp = $("#temp").val();
            var tst = `<div class="form-group row d-flex align-items-end criteriaappended-row">
                <div class="col-sm-2">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control" name="criteria_title[]" required>
                </div>

                <div class="col-sm-2">
                    <label class="control-label">Min</label>
                    <input type="text" class="form-control" name="criteria_min[]" required>
                </div>

                <div class="col-sm-2">
                    <label class="control-label">Max</label>
                    <input type="text" name="criteria_max[]" class="form-control">
                </div>

                <div class="col-sm-2">
                    <label class="control-label">Date</label>
                    <input type="date" name="criteria_date[]" class="form-control">
                </div>

            <div class="col-md-1" style="margin-top: 45px;">
                <input class="criteriaremoveitemrow btn btn-sm btn-danger mr-1" type="button" value="Remove row">
            </div>

        </div>`

            $('#criteria').append(tst);
            selectRefresh();
        });

        $(document).on('click', '.criteriaremoveitemrow', function() {
            $(this).closest('.criteriaappended-row').remove();
        })

        // For Eligibility
        $(document).on('click', '#eligibility_additemrow', function() {
            var b = parseFloat($("#eligibility_temp").val());
            b = b + 1;
            $("#temp").val(b);
            var temp = $("#temp").val();
            var tst = `<div class="form-group row d-flex align-items-end eligibilityappended-row">
                <div class="col-sm-3">
                    <label class="control-label">Stream</label>
                    <input type="text" class="form-control" name="eligibility_stream[]" required>
                </div>

                <div class="col-sm-3">
                    <label class="control-label">Level</label>
                    <input type="text" class="form-control" name="eligibility_level[]" required>
                </div>

                <div class="col-sm-3">
                    <label class="control-label">Grade</label>
                    <input type="text" name="eligibility_grade[]" class="form-control" required>
                </div>


            <div class="col-md-1" style="margin-top: 45px;">
                <input class="eligibilityremoveitemrow btn btn-sm btn-danger mr-1" type="button" value="Remove row">
            </div>

        </div>`

            $('#eligibility').append(tst);
            selectRefresh();
        });

        $(document).on('click', '.eligibilityremoveitemrow', function() {
            $(this).closest('.eligibilityappended-row').remove();
        })
    </script>
@endsection
