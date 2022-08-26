<div class="tab-pane p-3 active" id="basic" role="tabpanel">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group ">
                <label for="name" class="col-form-label pt-0">Application Name</label>
                <div class="">
                    <input type="hidden" class="form-control" name="user_id" value="">
                    <input class="form-control" type="text" required name="applicant"
                        placeholder="Applicant Name" value="{{ old('applicant', isset($student->applicant) ? $student->applicant : '') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group ">
                <label for="name" class="col-form-label pt-0">First Name</label>
                <div class="">
                    <input type="hidden" class="form-control" name="user_id" value="">
                    <input class="form-control" type="text" required name="first_name"
                        placeholder="First Name" value="{{ old('first_name', isset($student->first_name) ? $student->first_name : '') }}">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group ">
                <label for="name" class="col-form-label pt-0">Middle Name</label>
                <div class="">
                    <input class="form-control" type="text" name="middle_name"
                        placeholder="Middle Name" value="{{ old('middle_name', isset($student->middle_name) ? $student->middle_name : '') }}">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group ">
                <label for="name" class="col-form-label pt-0">Last Name</label>
                <div class="">
                    <input class="form-control" type="text" required name="last_name"
                        placeholder="Last Name" value="{{ old('last_name', isset($student->last_name) ? $student->last_name : '') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="email" class="col-form-label pt-0">Email</label>
                <div class="">
                    <input type="email" class="form-control" required name="email"
                        placeholder="Email" value="{{ old('email', isset($student->email) ? $student->email : '') }}">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="phone_no" class="col-form-label pt-0">Mobile No.</label>
                <div class="">
                    <input type="number" class="form-control" required name="mobile_no"
                        placeholder="Mobile Number" value="{{ old('mobile_no', isset($student->mobile_no) ? $student->mobile_no : '') }}">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="phone_no" class="col-form-label pt-0">Mobile No. (Alternate)</label>
                <div class="">
                    <input type="number" class="form-control" required
                        name="alternate_mobile_no" placeholder="Mobile Number" value="{{ old('alternate_mobile_no', isset($student->alternate_mobile_no) ? $student->alternate_mobile_no : '') }}">
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-4">
            <h6>Gender</h6>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                    value="male"  @if (isset($student) && $student->gender == 'male') checked @endif>
                <label class="form-check-label" for="inlineRadio1">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                    value="female"  @if (isset($student) && $student->gender == 'female') checked @endif>
                <label class="form-check-label" for="inlineRadio2">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio3"
                    value="other"  @if (isset($student) && $student->gender == 'other') checked @endif>
                <label class="form-check-label" for="inlineRadio3">Other</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="dob" class="col-form-label pt-0">Date of Birth (DOB)</label>
                <div class="">
                    <input type="date" class="form-control" name="dob" value="{{ old('dob', isset($student->dob) ? $student->dob : '') }}">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="marital_status" class="col-form-label pt-0">Married?</label>
                <div class="">
                    <select data-placeholder="Select Marital status"
                        class="tail-select form-control" name="material_status" id="marital_status">
                        <option value="#" disabled selected>Married or Not?</option>
                        <option value="Yes"  @if (isset($student) && $student->material_status == 'Yes') selected @endif>Yes</option>
                        <option value="No"  @if (isset($student) && $student->material_status == 'No') selected @endif>No</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row spouse-name"  @if (isset($student) && $student->material_status == 'No') style="display: none;" @endif>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="spouse_name" class="col-form-label pt-0">Spouse's Name</label>
                <div class="">
                    <input type="text" class="form-control" name="spouse_name"
                        placeholder="Spouse's Name" value="{{ old('spouse_name', isset($student->spouse_name) ? $student->spouse_name : '') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="father_name" class="col-form-label pt-0">Father's Name</label>
                <div class="">
                    <input type="text" class="form-control" name="father_name"
                        placeholder="Father's Name" value="{{ old('father_name', isset($student->father_name) ? $student->father_name : '') }}">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="mother_name" class="col-form-label pt-0">Mother's Name</label>
                <div class="">
                    <input type="text" class="form-control" name="mother_name"
                        placeholder="Mother's Name" value="{{ old('mother_name', isset($student->mother_name) ? $student->mother_name : '') }}">
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="specialization" class="col-form-label pt-0">Select Country</label>
                <div class="">
                    <select data-placeholder="Select Country"
                        class="form-control country_id" id="country_id"
                        name="country_id">
                        <option value="" disabled selected>Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if (isset($student) && $student->country_id == $country->id) selected @endif>
                                {{ ucfirst($country->country_name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="province" class="col-form-label pt-0">Select Province/State</label>
                <div class="">
                    <select data-placeholder="Select Province"
                        class="tail-select form-control state_class" id="province_id"
                        name="state_id">
                        <option value="" selected disabled >Select Province</option>
                        @if(isset($states))
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" @if (isset($student) && $student->state_id == $state->id) selected @endif>
                                {{ $state->state_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="districts" class="col-form-label pt-0">Select District</label>
                <div class="">
                    <select data-placeholder="Select District"
                        class="tail-select form-control district_class" id="district_id"
                        name="district_id">
                        <option value="" selected disabled>Select District</option>
                        @if(isset($districts))
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" @if (isset($student) && $student->district_id == $district->id) selected @endif>
                                    {{ $district->district_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="municipality"
                    class="col-form-label pt-0">Metro/Sub-Metro/Municipality/VDC</label>
                <input type="text" class="form-control" name="municipality_name"
                    placeholder="Municipality" value="{{ old('municipality_name', isset($student->municipality_name) ? $student->municipality_name : '') }}">

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="municipality" class="col-form-label pt-0">Ward No.</label>
                <input type="number" class="form-control" name="ward_no" placeholder="Ward" value="{{ old('ward_no', isset($student->ward_no) ? $student->ward_no : '') }}">

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="municipality" class="col-form-label pt-0">Village/Town/City</label>
                <input type="text" class="form-control" name="village_name" value="{{ old('village_name', isset($student->village_name) ? $student->village_name : '') }}">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label for="address" class="col-form-label pt-0">Address</label>
            <input type="text" class="form-control" name="full_address" value="{{ old('full_address', isset($student->full_address) ? $student->full_address : '') }}">
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group ">
                <label for="preferred_field" class="col-form-label pt-0">Choose a Preferred Field</label>
                <div class="">
                    <select data-placeholder="Select Preferred Field" class="js-example-basic-multiple form-control" name="preferred_field[]" multiple="multiple">
                        <option value="it" @if(isset($fields) && in_array('it',$fields)) selected @endif>IT</option>
                        <option value="management" @if(isset($fields) && in_array('management',$fields)) selected @endif>Management</option>
                        <option value="nursing"  @if(isset($fields) && in_array('nursing',$fields)) selected @endif>Nursing</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group ">
                <label for="program" class="col-form-label pt-0">Prefered Intake(Year)</label>
                <div class="">
                    <select data-placeholder="Select Year"
                        class="select2 tail-select form-control " id=""
                        name="intake_year" required>
                        <option value="" selected disabled >Select Intake Year</option>
                        <option value="2022" {{ old('intake_year') == '2022' ? 'selected' : '' }} @if(isset($student) && $student->intake_year == "2022" ) selected @endif>2022</option>
                        <option value="2023" {{ old('intake_year') == '2023' ? 'selected' : '' }} @if(isset($student) && $student->intake_year == "2023" ) selected @endif>2023</option>

                    </select>
                    @error('intake_year')
                        <span class="text-danger">{{ $errors->first('intake_year') }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group ">
                <label for="program" class="col-form-label pt-0">Prefered Intake(Month)</label>
                <div class="">
                    <select data-placeholder="Select Intake Month"
                        class="select2 tail-select form-control " id=""
                        name="intake_month" required>
                        <option value="" selected disabled >Select Intake Month</option>
                        <option value="february" {{ old('intake_month') == 'february' ? 'selected' : '' }} @if(isset($student) && $student->intake_month == "february" ) selected @endif>February</option>
                        <option value="august" {{ old('intake_month') == 'august' ? 'selected' : '' }} @if(isset($student) && $student->intake_month == "august" ) selected @endif>August</option>
                        <option value="september" {{ old('intake_month') == 'september' ? 'selected' : '' }} @if(isset($student) && $student->intake_month == "september" ) selected @endif>September</option>

                    </select>
                    @error('intake_month')
                        <span class="text-danger">{{ $errors->first('intake_month') }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if(isset($student->ref_id) && isset($student->source_ref))
            <input type="hidden" name="ref_id" value="{{$student->ref_id}}">
        @endif
        <input type="hidden" name="">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="marital_status" class="col-form-label pt-0">Source Refrence</label>
                <div class="">
                    <select data-placeholder="Select Source Refrence"
                        class="tail-select form-control" name="source_ref" id="source_ref">
                        <option value="#" disabled selected>Source Refrence</option>
                        <option value="direct"  @if (isset($student) && $student->source_ref == 'direct') selected @endif>Direct</option>
                        <option value="agent"  @if (isset($student) && $student->source_ref == 'agent') selected @endif>Agent</option>
                        <option value="location"  @if (isset($student) && $student->source_ref == 'location') selected @endif>Location</option>
                        <option value="registration"  @if (isset($student) && $student->source_ref == 'registration') selected @endif>Registration</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row agent"  @if (isset($student) && $student->source_ref == 'agent') style="display: block;" @else style="display: none;" @endif >
        <div class="col-md-6">
            <div class="form-group">
                <label for="ref_id" class="col-form-label pt-0">Agent's Name</label>
                <div class="">
                    <select data-placeholder="Select Agent"
                        class="form-control agent_id" id="agent_id"
                        name="ref_id" width="100%">
                        <option value="" disabled selected>Select Agent</option>
                        @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}" @if (isset($student) && $student->ref_id == $agent->id) selected @endif>
                                {{ ucfirst($agent->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row location"  @if (isset($student) && $student->source_ref == 'location') style="display: block;" @else style="display: none;" @endif >
        <div class="col-md-6">
            <div class="form-group">
                <label for="ref_id" class="col-form-label pt-0">Select Location</label>
                <div class="">
                    <select data-placeholder="Select location"
                        class="form-control agent_id" id="agent_id"
                        name="ref_id" width="100%">
                        <option value="" disabled selected>Select location</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" @if (isset($student) && $student->ref_id == $location->id) selected @endif>
                                {{ ucfirst($location->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

