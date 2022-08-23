<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($admission->student->applicant, 47) }}</td>
    <td>{{ $admission->country->country_name }}, {{$admission->state->state_name}}</td>
    <td>{{ $admission->college->name }}</td>
    <td>
        {{ ucfirst($admission->intake_month) }}, {{$admission->intake_year}}
    </td>
    <td>{{ $admission->fees }}</td>

    <td>

        <a href="{{route('admission.commission', $admission->id)}}"  class="btn btn-primary btn-sm" title="Add Commission">
            Add Commission
        </a>

        @if(isset($admission->commissions) && $admission->commissions->isEmpty() == false)
            <button data-admission_id="{{$admission->id}}"  class="btn btn-warning btn-sm viewhistory" title="Add Commission">
                View Payment
            </button>
            <a href="{{route('admission.generateinvoice',$admission->id)}}" >
                <button type="button" class="btn btn-danger btn-reject btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Generate Bill">Generate Invoice</button>
            </a>
        @endif



        {{-- @if(!$admission->claimCommission->isEmpty())
            <button data-commission_id="{{$admission->claimCommission->first()->commissions_id}}"  class="btn btn-warning btn-sm changestatus" title="Claim Commission">
                Claim Commission
            </button>
            <input type="hidden" class="upcoming_commission_date" value="{{$admission->claimCommission->first()->claim_date}}">
            <input type="hidden" class="upcoming_commission_title" value="{{$admission->claimCommission->first()->title}}">
        @endif --}}
    </td>
</tr>

