<tr style="background: @if(!empty($registration->leadcategory)) {{$registration->leadcategory->color_code}} @endif">
    <td class="text-center pt-3">
        <div class="custom-checkbox custom-control">
            <input type="checkbox" name="registrationcheckbox" data-checkboxes="mygroup" class="custom-control-input registrationcheckbox" id="{{$registration->id}}" value="{{$registration->id}}">
            <label for="{{$registration->id}}" class="custom-control-label">&nbsp;</label>
        </div>
    </td>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($registration->name, 47) }}</td>
    <td>{{ Str::limit($registration->email, 47) }}</td>
    <td>{{ Str::limit($registration->phone, 47) }}</td>
    <td>{{ Str::limit($registration->source, 47) }}</td>
    <td>{{ ucfirst($registration->preffered_location) }}</td>
    <td>{{ $registration->coupen_code }}</td>

    <td >
        <a href="javascript: void(0);"  data-registration_id="{{$registration->id}}"  class="btn btn-flat mdi mdi-pencil btn-edit" title="Edit Registration">
        </a>
        <a href="{{route('registration.show', $registration->id)}}" class="btn btn-flat btn-primary btn-sm" title="view">
            <i class="fa fa-eye"></i>
        </a>
        <a href="{{route('registration.print', $registration->id)}}" class="btn btn-flat btn-sm" title="print">
            <i class="fa fa-print"></i>
        </a>
        <a href="#">
            <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('registration.destroy', $registration->id) }}">
                <i class="far fa-trash-alt"></i>
            </button>
        </a>

        <a href="javascript: void(0);" data-registration_id="{{$registration->id}}"  class="btn btn-secondary btn-sm addfollowup" title="Add Follow Up">
            Add Follow Up @if(!empty($registration->getFollowUpCount($registration->id))) ({{$registration->getFollowUpCount($registration->id)->count()}}) @endif
        </a>

        <a href="javascript: void(0);" data-registration_id="{{$registration->id}}"  class="btn btn-info btn-sm sendsms mt-1" title="Add Follow Up">
            Send SMS
        </a>

        <a href="javascript: void(0);" data-registration_id="{{$registration->id}}"  class="btn btn-warning btn-sm btn-leadcategory mt-1" title="Add Lead Category">
            Lead Category
        </a>

        @if($registration->enroll($registration->id) == null)
            <a href="#">
                <button type="button" class="btn btn-purple btn-sm btn-icon-toggle mt-1" onclick="proceedThis(this); return false;" link="{{ route('registration.proceed_for_admission', $registration->id) }}">
                    Proceed To Enroll
                </button>
            </a>
        @endif


    </td>
</tr>


