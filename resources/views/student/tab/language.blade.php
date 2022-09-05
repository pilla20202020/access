<div class="tab-pane p-3" id="language" role="tabpanel">
    <div id="language" >
        @if (isset($student->languages) && $student->languages->isEmpty() == false)
            @foreach ($student->languages as $key => $language)
                <div class="form-group d-flex align-items-end">.

                    <input type="hidden" class="form-control" name="language_id[{{ $key }}]" value={{ $language->id }}>
                    <div class="col-sm-3">
                        <input type="hidden" class="form-control" name="candidate_id">
                        <label class="control-label">Language</label>
                        <select name="language[]" class="form-control">
                            <option value="#" disabled selected>Select Language</option>
                            <option value="ielts" @if($language->language == "ielts") selected @endif>Ielts</option>
                            <option value="sat" @if($language->language == "sat") selected @endif>SAT</option>
                            <option value="tofel" @if($language->language == "tofel") selected @endif>TOFEL</option>
                            <option value="pte" @if($language->language == "pte") selected @endif>PTE</option>
                            <option value="gre" @if($language->language == "gre") selected @endif>GRE</option>
                            <option value="other" @if($language->language == "other") selected @endif>Other</option>
                        </select>
                    </div>


                    <div class="col-sm-2">
                        <label class="control-label">Score</label>
                        <input type="text" name="score[]"
                            class="form-control" min="0" max="100" value="{{$language->score}}">
                    </div>

                    <div class="col-sm-3">
                        <label class="control-label">Certification Upload</label>
                        <input type="file" name="language_documents[]" class="form-control" >
                    </div>

                    <div class="col-md-1">
                        <a href="{{ asset('storage/'.$language->language_documents) }}" target="__blank" name="language_documents[]">
                            View Uploaded File
                        </a>
                    </div>

                    <div class="col-md-1" style="margin-top: 45px;">
                        <a href="{{route('student.delete_test',$language->id)}}" class="btn btn-sm btn-danger mr-1 p-2" type="submit" value=""><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="form-group row d-flex align-items-end">
            @if (isset($student))
                <div class="col-md-1" style="margin-top: 45px;">
                    <input id="lang_additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @else
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
                    <input id="lang_additemrow" type="button" class="btn btn-sm btn-primary mr-1" value="Add Row">
                </div>
            @endif


        </div>
    <input type="hidden" id="lang_temp" value="0" name="temp">
</div>
</div>



