<div class="tab-pane p-3 " id="intake" role="tabpanel">
    <h5>Intake Entry</h5>
    <div id="additernary">
        @if (isset($program->intakes) && $program->intakes->isEmpty() == false)
            @foreach ($program->intakes as $key => $education)
            <input type="hidden" class="form-control" name="intake_id[{{ $key }}]" value={{ $education->id }}>
                <div class="form-group d-flex align-items-end">
                    <div class="col-sm-2">
                        <label class="control-label">Title</label>
                        <input type="text" class="form-control" name="intake_title[]" value="{{$education->title}}">
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
                        <a href="{{route('program.delete_intake', $education->id)}}" class="btn btn-sm btn-danger mr-1 p-2" type="submit" value=""><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="form-group row d-flex align-items-end">
            @if (isset($program))
                <div class="col-md-1" style="margin-top: 45px;">
                    <input id="additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @else
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
                    <input id="additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @endif
        </div>
        <input type="hidden" id="temp" value="0" name="temp">
    </div>
</div>
