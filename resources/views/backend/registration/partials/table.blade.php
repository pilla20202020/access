<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($registration->name, 47) }}</td>
    <td>{{ Str::limit($registration->email, 47) }}</td>
    <td>{{ Str::limit($registration->phone, 47) }}</td>
    <td>{{ Str::limit($registration->address, 47) }}</td>

    <td class="text-right">
        <a href="{{route('registration.show', $registration->id)}}" class="btn btn-flat btn-primary btn-xs" title="edit">
            <i class="fa fa-eye"></i>
        </a>
        <a href="{{ route('registration.destroy', $registration->id) }}">
        <button type="button"
            class="btn btn-flat btn-danger btn-xs item-delete" title="delete">
            <i class="glyphicon glyphicon-trash"></i>
        </button>
    </td>
</tr>


