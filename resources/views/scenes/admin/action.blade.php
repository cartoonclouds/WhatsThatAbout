<a href="{{ $scene->url }}" class="btn btn-sm btn-primary">View</a>
<a href="{{ url("admin/scenes/$scene->slug/edit") }}" class="btn btn-sm btn-outline-primary">Edit</a>
<button type="button" class="btn btn-sm btn-danger ml-auto" data-bootbox="delete" data-url="{{ url("api/scenes/$scene->slug") }}">Delete</button>
