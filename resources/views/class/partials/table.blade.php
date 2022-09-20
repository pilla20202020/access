<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($class->name, 47) }}</td>
    <td>{{ $class->timing }}</td>
    <td>
        <a href="{{route('classes.edit', $class->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('classes.destroy', $class->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

