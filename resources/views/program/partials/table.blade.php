<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($program->title, 47) }}</td>

    <td>{{ Str::limit($program->contact_person, 47) }}</td>
    <td>{{ Str::limit($program->contact_email, 47) }}</td>
    <td>{{ Str::limit($program->contact_number, 47) }}</td>

    <td>
        <a href="{{route('program.edit', $program->id)}}">
            <button type="button" class="btn btn-icon-toggle btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="mdi mdi-pencil"></i></button>
        </a>
        <a href="#">
            <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('program.destroy', $program->id) }}">
                <i class="far fa-trash-alt"></i>
            </button>
        </a>
    </td>
</tr>


