<a href="{{ $page->url }}" class="btn btn-sm btn-primary">View</a>
<a href="{{ url("admin/pages/$page->slug/edit") }}" class="btn btn-sm btn-outline-primary">Edit</a>
<button type="button" class="btn btn-sm btn-danger ml-auto" data-bootbox="delete" data-url="{{ url("api/pages/$page->slug") }}">Delete</button>
