<a href="{{ $theme->url }}" class="btn btn-sm btn-primary">View</a>
<a href="{{ url("admin/themes/$theme->slug/edit") }}" class="btn btn-sm btn-outline-primary">Edit</a>
@can('delete', $theme)
    <button type="button" class="btn btn-sm btn-danger ml-auto" data-bootbox="delete" data-model="theme" data-url="{{ url("api/admin/theme/$theme->slug") }}">Delete</button>
@endcan
