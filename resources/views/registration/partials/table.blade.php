<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($registration->name, 47) }}</td>
    <td>{{ Str::limit($registration->email, 47) }}</td>
    <td>{{ Str::limit($registration->phone, 47) }}</td>
    <td>{{ Str::limit($registration->address, 47) }}</td>

    <td >
        <a href="{{route('registration.show', $registration->id)}}" class="btn btn-flat btn-primary btn-sm" title="edit">
            <i class="fa fa-eye"></i>
        </a>
        <a href="#">
            <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('registration.destroy', $registration->id) }}">
                <i class="far fa-trash-alt"></i>
            </button>
        </a>
        @if(empty($registration->getFollowUp($registration->id)))

            <a href="javascript: void(0);" data-commission_id="{{$registration->id}}"  class="btn btn-secondary btn-sm addfollowup" title="Add Follow Up">
                Add Follow Up
            </a>
        @elseif($registration->getFollowUp($registration->id)->next_schedule < date('Y-m-d'))
            <a href="javascript: void(0);" data-commission_id="{{$registration->id}}"  class="btn btn-secondary btn-sm addfollowup" title="Add Follow Up">
                Add Follow Up
            </a>
        @endif

    </td>
</tr>


