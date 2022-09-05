<div class="tab-pane p-3" id="eligibility" role="tabpanel">
    <h5>Eligibility Entry</h5>
    <div id="eligibility">
        @if (isset($program->eligibilities) && $program->eligibilities->isEmpty() == false)
            @foreach ($program->eligibilities as $key => $education)
            <input type="hidden" class="form-control" name="eligibility_id[{{ $key }}]" value={{ $education->id }}>
                <div class="form-group d-flex align-items-end">
                    <div class="col-sm-2">
                        <label class="control-label">Stream</label>
                        <input type="text" class="form-control" name="eligibility_stream[]" value="{{$education->stream}}">
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Level</label>
                        <input type="text" class="form-control" name="eligibility_level[]" value="{{$education->level}}">
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Grade</label>
                        <input type="text" name="eligibility_grade[]" class="form-control" value="{{$education->grade}}">
                    </div>


                    <div class="col-md-1" style="margin-top: 45px;">
                        <a href="{{route('program.delete_eligibility', $education->id)}}" class="btn btn-sm btn-danger mr-1 p-2" type="submit" value=""><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="form-group row d-flex align-items-end">
            @if (isset($program))
                <div class="col-md-1" style="margin-top: 45px;">
                    <input id="eligibility_additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @else
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
                    <input id="eligibility_additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @endif
        </div>
        <input type="hidden" id="eligibility_temp" value="0" name="temp">
    </div>
</div>
