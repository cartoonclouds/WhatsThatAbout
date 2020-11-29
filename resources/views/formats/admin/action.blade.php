<a href="{{ $format->url }}" class="btn btn-sm btn-primary">View</a>
@can('update', $format)
    <a href="{{ url("admin/formats/$format->slug/edit") }}" class="btn btn-sm btn-outline-primary">Edit</a>
@endcan
@can('delete', $format)
    <button type="button" class="btn btn-sm btn-danger ml-auto" data-bootbox="delete" data-model="format" data-url="{{ url("api/admin/format/$format->slug") }}">Delete</button>
@endcan
