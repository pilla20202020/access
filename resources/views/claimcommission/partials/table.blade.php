<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($claimCommission->commission->student->name, 47) }}</td>
    <td>{{ Str::limit($claimCommission->commission->admission->college, 47) }}</td>
    <td>{{ $claimCommission->commission->claim_date }}</td>
    <td>{{ Str::limit($claimCommission->commission->student->program, 47) }}</td>
    <td>{{ $claimCommission->commission->fees }}</td>
    <td>{{ $claimCommission->commission_claim_date }}</td>
    <td>
        @if($claimCommission->commissions_claim_status == "paid")
            <span class='badge badge-success p-1'>{{ucfirst($claimCommission->commissions_claim_status)}}</span>
        @elseif($claimCommission->commissions_claim_status == "pending")
            <span class='badge badge-warning p-1'>{{ucfirst($claimCommission->commissions_claim_status)}}</span>
            <a href="javascript: void(0);" data-commission_id="{{$claimCommission->claim_commissions_id}}"  class="btn btn-secondary btn-sm mr-1 p-2 ml-2 addfollowup" title="Add Follow Up">
                Add Follow Up
            </a>
        @else
            <span class='badge badge-danger p-1'>{{ucfirst($claimCommission->commissions_claim_status)}}</span>
            <a href="javascript: void(0);" data-commission_id="{{$claimCommission->claim_commissions_id}}"  class="btn btn-secondary btn-sm mr-1 p-1 ml-2 addfollowup" title="Add Follow Up">
                Add Follow Up
            </a>
        @endif
    </td>


</tr>

