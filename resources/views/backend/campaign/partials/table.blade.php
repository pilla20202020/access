<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($campaign->name, 47) }}</td>
    <td>
        <img src="{{asset($campaign->thumbnail_path)}}" class="img-circle width-1" alt="{{$campaign->name}}" width="50" height="50">
    </td>
    <td>{{ Str::limit($campaign->details, 47) }}</td>
    <td>{{ Str::limit($campaign->starts, 47) }}</td>
    <td>{{ Str::limit($campaign->ends, 47) }}</td>

    <td class="text-right">
        <a href="{{route('campaign.edit', $campaign->id)}}" class="btn btn-flat btn-primary btn-xs" title="edit">
            <i class="glyphicon glyphicon-edit"></i>
        </a>
        <a href="{{ route('campaign.destroy', $campaign->id) }}">
        <button type="button"
            class="btn btn-flat btn-danger btn-xs item-delete" title="delete">
            <i class="glyphicon glyphicon-trash"></i>
        </button>
    </td>
</tr>


