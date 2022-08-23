<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($admission->student->applicant, 47) }}</td>
    <td>{{ $admission->country->country_name }}, {{$admission->state->state_name}}</td>
    <td>{{ $admission->college->name }}</td>
    <td>
        {{ ucfirst($admission->intake_month) }}, {{$admission->intake_year}}
    </td>
    <td>{{ Str::limit($admission->student->program, 47) }}</td>
    <td>{{ $admission->fees }}</td>

    <td>
        <a href="{{route('admission.edit', $admission->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('admission.destroy', $admission->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
        @if(getCommencedByStudent($admission->student_id) == true)
            <button data-admission_id="{{$admission->id}}"  class="btn btn-warning btn-sm addcommencement" title="Add Commencement">
                Add Commencement
            </button>
            <input type="hidden" class="student_id" value="{{$admission->student_id}}">
        @elseif (($admission->commenced_status == "applied") && ($admission->commenced_date != null))
            <span class="badge badge-primary">Applied</span>
        @else
            <span class="badge badge-danger">UnApplied</span>
        @endif

        {{-- <a href="{{route('admission.commission', $admission->id)}}"  class="btn btn-primary btn-sm" title="Add Commission">
            Add Commission
        </a>

        <button data-admission_id="{{$admission->id}}"  class="btn btn-warning btn-sm viewhistory" title="Add Commission">
            View Payment
        </button>

        @if(!$admission->claimCommission->isEmpty())
            <button data-commission_id="{{$admission->claimCommission->first()->commissions_id}}"  class="btn btn-warning btn-sm changestatus" title="Claim Commission">
                Claim Commission
            </button>
            <input type="hidden" class="upcoming_commission_date" value="{{$admission->claimCommission->first()->claim_date}}">
            <input type="hidden" class="upcoming_commission_title" value="{{$admission->claimCommission->first()->title}}">
        @endif --}}
    </td>
</tr>

