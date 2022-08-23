<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($agent->name, 47) }}</td>
    <td>{{ $agent->email }}</td>
    <td>{{ Str::limit($agent->phone, 47) }}</td>
    <td>
        <a href="{{route('agent.edit', $agent->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('agent.destroy', $agent->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

