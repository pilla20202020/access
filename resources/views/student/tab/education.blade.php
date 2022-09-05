<div class="tab-pane p-3" id="education" role="tabpanel">
    <div id="additernary">
        @if (isset($student->educations) && $student->educations->isEmpty() == false)
            @foreach ($student->educations as $key => $education)
                <div class="form-group d-flex align-items-end">
                    <div class="col-sm-2">
                        <input type="hidden" class="form-control" name="candidate_id">
                        <input type="hidden" class="form-control" name="qualification_id[{{ $key }}]" value={{ $education->id }}>
                        <label class="control-label">Level</label>
                        <select name="level[]" class="form-control">
                            <option value="#" disabled selected>Select Education</option>
                            <option value="slc" @if($education->level == "slc") selected @endif>SLC/SEE</option>
                            <option value="highschool" @if($education->level == "highschool") selected @endif>10+2 / A-Levels</option>
                            <option value="bachelor" @if($education->level == "bachelor") selected @endif>Bachelors</option>
                            <option value="diploma" @if($education->level == "diploma") selected @endif>Diploma</option>
                            <option value="masters" @if($education->level == "masters") selected @endif>Masters</option>
                            <option value="other" @if($education->level == "other") selected @endif>Other</option>
                        </select>
                    </div>

                    <div class="col-sm-3">
                        <label class="control-label">Institute / University</label>
                        <input type="text" class="form-control" name="university[]" value="{{$education->university}}">
                        {{-- <select name="s_u_id[]" id="s_u_dopdown" class="form-control">
                        <option value="#" selected disabled>Choose an option</option>
                        @foreach ($institutions as $institute)
                            <option value="{{$institute->id}}">{{$institute->s_u_name}}</option>
                        @endforeach
                    </select> --}}
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Percentage</label>
                        <input type="text" name="percentage[]" class="form-control" min="0" max="100" value="{{$education->percentage}}">
                    </div>

                    <div class="col-sm-3">
                        <label class="control-label">Certification Upload</label>
                        <input type="file" name="documents[]" class="form-control">
                    </div>

                    <div class="col-md-1">
                        <a href="{{ asset('storage/'.$education->documents) }}" target="__blank">
                            View Uploaded File
                        </a>
                    </div>


                    <div class="col-md-1" style="margin-top: 45px;">
                        <a href="{{route('student.delete_academic',$education->id)}}" class="btn btn-sm btn-danger mr-1 p-2" type="submit" value=""><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="form-group row d-flex align-items-end">
            @if (isset($student))
                <div class="col-md-1" style="margin-top: 45px;">
                    <input id="additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @else
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
                    <input type="text" class="form-control" name="university[]" required>
                    {{-- <select name="s_u_id[]" id="s_u_dopdown" class="form-control">
                        <option value="#" selected disabled>Choose an option</option>
                        @foreach ($institutions as $institute)
                            <option value="{{$institute->id}}">{{$institute->s_u_name}}</option>
                        @endforeach
                    </select> --}}
                </div>

                <div class="col-sm-2">
                    <label class="control-label">Percentage</label>
                    <input type="number" name="percentage[]" class="form-control" min="0" max="100" required>
                </div>

                <div class="col-sm-3">
                    <label class="control-label">Certification Upload</label>
                    <input type="file" name="documents[]" class="form-control" required>
                </div>

                <div class="col-md-1" style="margin-top: 45px;">
                    <input id="additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @endif


        </div>
        <input type="hidden" id="temp" value="0" name="temp">
    </div>
</div>
