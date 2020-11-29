<a href="{{ $genre->url }}" class="btn btn-sm btn-primary">View</a>
<a href="{{ url("admin/genres/$genre->slug/edit") }}" class="btn btn-sm btn-outline-primary">Edit</a>
@can('delete', $genre)
    <button type="button" class="btn btn-sm btn-danger ml-auto" data-bootbox="delete" data-model="genre" data-url="{{ url("api/admin/genre/$genre->slug") }}">Delete</button>
@endcan
