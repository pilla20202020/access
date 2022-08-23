@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
@csrf
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="province" class="col-form-label pt-0">Select Students <span class="text-danger">*</span></label>
                                <div class="">
                                    <select data-placeholder="Select Students"
                                        class="select2 tail-select form-control " id=""
                                        name="student_id" required>
                                        <option value="" selected disabled >Select Students</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}" @if(old('student_id') == $student->id) selected @endif @if(isset($admission) && ($admission->student_id == $student->id)) selected @endif>{{ ucfirst($student->applicant) }}</option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <span class="text-danger">{{ $errors->first('student_id') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="country" class="form-label">Country</label>
                                <select name="country_id" id="country_dropdown" class="form-control" required >
                                    <option value="#" selected disabled>Choose country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}" @if(old('country_id') == $country->id) selected @endif @if(isset($admission) && ($admission->country_id == $country->id)) selected @endif>{{$country->country_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="country" class="form-label">State</label>
                                <select name="state_id" id="state_dropdown" class="form-control" required>
                                    @if(isset($admission))
                                        @foreach ($states as $state)
                                            <option value="{{$state->id}}" @if(old('state_id') == $state->id) selected @endif @if(isset($admission) && ($admission->state_id == $state->id)) selected @endif>{{$state->state_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="college_id" class="col-form-label pt-0">Select College</label>
                                <div class="">
                                    <select data-placeholder="Select College"
                                        class="tail-select form-control college_class" id="college_id"
                                        name="college_id" >
                                        <option value="" selected disabled>Select College</option>
                                        @if(isset($admission))
                                            @foreach ($colleges as $college)
                                                <option value="{{$college->id}}" @if(old('college_id') == $college->id) selected @endif @if(isset($admission) && ($admission->college_id == $college->id)) selected @endif>{{$college->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label for="fees" class="col-form-label pt-0">Fees</label>
                                <div class="">
                                    <input class="form-control" type="number" name="fees" data-role="tagsinput"
                                    value="{{ old('fees', isset($admission->fees) ? $admission->fees : '') }}" placeholder="Enter a Fees">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label for="intake_year" class="col-form-label pt-0">Intake(Year)</label>
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
                                <label for="intake_month" class="col-form-label pt-0">Intake(Month)</label>
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

                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('admission.index') }}">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


@section('page-specific-scripts')
    <script src="{{asset('resources/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#country_dropdown').select2();
            $('#state_dropdown').select2();
            $('#college_id').select2();


            $('#country_dropdown').on('change',function(e){
            e.preventDefault();
            var country_id = $(this).val();
            // alert(country_id);
                $.ajax({
                    type: "GET",
                    url: "{{route('colleges.get_states')}}",
                    data: {
                        'country_id': country_id
                    },
                    dataType: "json",
                    success: function(response){
                        // console.log(response);
                        $('#state_dropdown').html('<option value="#" selected disabled>Choose State</option>');
                        $.each(response.message, function(key,value){
                            $('#state_dropdown').append('<option value='+value.id+'>'+value.state_name+'</option>');
                        });
                    }
                });
            });

            $('#state_dropdown').on('change', function(e) {
                e.preventDefault();
                var state_id = $(this).val();
                var body = "";
                $.ajax({
                    type: 'POST',
                    url: "{{route('common.college.provinceId')}}",
                    data: {
                        _token: $("meta[name='csrf-token']").attr('content'),
                        state_id: state_id,
                    },
                    success: function(response) {
                        $('#college_id').html('');
                        body = '<option value="" selected disabled>Select College</option>';
                        if (response.colleges) {
                            $.each(response.colleges, function(key, college) {
                                body += "<option value='" + college['id'] + "'>" + college['name'] + "</option>";
                            });
                            $('#college_id').html(body);
                        }
                    }
                })
            })
        });
    </script>
@endsection
