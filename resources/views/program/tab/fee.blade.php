<div class="tab-pane p-3" id="fee" role="tabpanel">
    <h5>Fee Entry</h5>
    <div id="fee">
        @if (isset($program->fees) && $program->fees->isEmpty() == false)
            @foreach ($program->fees as $key => $education)
                <div class="form-group d-flex align-items-end">
                    <div class="col-sm-2">
                        <label class="control-label">Title</label>
                        <input type="text" class="form-control" name="fee_title[]" value="{{$education->title}}">
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Intake Dates</label>
                        <input type="date" class="form-control" name="intake_date[]" value="{{$education->intake_date}}">
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Class Commencement</label>
                        <input type="date" name="class_commencement[]" class="form-control" value="{{$education->class_commencement}}">
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Deadline Date</label>
                        <input type="date" name="deadline_date[]" class="form-control" value="{{$education->deadline_date}}">
                    </div>


                    <div class="col-md-1" style="margin-top: 45px;">
                        <a href="#" class="btn btn-sm btn-danger mr-1 p-2" type="submit" value=""><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="form-group row d-flex align-items-end">
            @if (isset($program))
                <div class="col-md-1" style="margin-top: 45px;">
                    <input id="fee_additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @else
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
                    <input id="fee_additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @endif
        </div>
        <input type="hidden" id="fee_temp" value="0" name="temp">
    </div>
</div>
