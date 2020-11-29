<a href="{{ $page->url }}" class="btn btn-sm btn-primary">View</a>
@can('update', $page)
    <a href="{{ url("admin/pages/$page->slug/edit") }}" class="btn btn-sm btn-outline-primary">Edit</a>
@endcan
@can('delete', $page)
    <button type="button" class="btn btn-sm btn-danger ml-auto" data-bootbox="delete" data-model="page" data-url="{{ url("api/admin/page/$page->slug") }}">Delete</button>
@endcan
