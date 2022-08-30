<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($document_checklist->checklist_for, 47) }}</td>
    <td>{{ $document_checklist->checklist_name }}</td>
    <td>
        <a href="{{route('document_checklist.edit', $document_checklist->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('document_checklist.destroy', $document_checklist->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>

        <a href="{{route('document_checklist.replicate', $document_checklist->id)}}"  class="btn btn-icon-toggle btn-sm" title="Replicate">
            <i class="fas fa-copy"></i>
        </a>
    </td>
</tr>

