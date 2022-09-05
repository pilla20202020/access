<div class="tab-pane p-3" id="criteria" role="tabpanel">
    <h5>Criteria Entry</h5>

    <div id="criteria">
        @if (isset($program->criterias) && $program->criterias->isEmpty() == false)
            @foreach ($program->criterias as $key => $education)
            <input type="hidden" class="form-control" name="criteria_id[{{ $key }}]" value={{ $education->id }}>
                <div class="form-group d-flex align-items-end">
                    <div class="col-sm-2">
                        <label class="control-label">Title</label>
                        <input type="text" class="form-control" name="criteria_title[]" value="{{$education->title}}">
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Min</label>
                        <input type="text" class="form-control" name="criteria_min[]" value="{{$education->min}}">
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Max</label>
                        <input type="text" name="criteria_max[]" class="form-control" value="{{$education->max}}">
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Date</label>
                        <input type="date" name="criteria_date[]" class="form-control" value="{{$education->date}}">
                    </div>

                    <div class="col-md-1" style="margin-top: 45px;">
                        <a href="{{route('program.delete_criteria', $education->id)}}" class="btn btn-sm btn-danger mr-1 p-2" type="submit" value=""><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="form-group row d-flex align-items-end">
            @if (isset($program))
                <div class="col-md-1" style="margin-top: 45px;">
                    <input id="criteria_additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @else
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
                    <input id="criteria_additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @endif
        </div>
        <input type="hidden" id="criteria_temp" value="0" name="temp">
    </div>
</div>
