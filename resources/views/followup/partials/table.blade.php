
@if(!empty($followup->registration($followup->id)))

<tr>
    <td>{{++$key}}</td>
    <td>{{ $followup->registration($followup->id)->name}}</td>
    <td>{{ $followup->registration($followup->id)->email }}</td>
    <td>{{ $followup->registration($followup->id)->phone }}</td>
    <td>{{ $followup->next_schedule }}</td>
    <td>{{ Str::limit($followup->follow_up_by, 47) }}</td>
    <td>{{ Str::limit($followup->remarks, 47) }}</td>

    <td >
        <a href="{{route('followup.show', $followup->id)}}" class="btn btn-flat btn-primary btn-sm" title="edit">
            <i class="fa fa-eye"></i>
        </a>
        <a href="#">
            <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('followup.destroy', $followup->id) }}">
                <i class="far fa-trash-alt"></i>
            </button>
        </a>


    </td>
</tr>
@endif


