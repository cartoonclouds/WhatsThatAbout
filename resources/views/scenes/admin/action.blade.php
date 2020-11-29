<a href="{{ $scene->url }}" class="btn btn-sm btn-primary">View</a>
@can('update', $scene)
    <a href="{{ url("admin/scenes/$scene->slug/edit") }}" class="btn btn-sm btn-outline-primary">Edit</a>
@endcan
@can('delete', $scene)
    <button type="button" class="btn btn-sm btn-danger ml-auto" data-bootbox="delete" data-model="scene" data-url="{{ url("api/admin/scene/$scene->slug") }}">Delete</button>
@endcan
