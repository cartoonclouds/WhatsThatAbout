<a href="{{ $user->url }}" class="btn btn-sm btn-primary">View</a>
<a href="{{ url("admin/users/$user->id/edit") }}" class="btn btn-sm btn-outline-primary">Edit</a>
@can('delete', $user)
    <button type="button" class="btn btn-sm btn-danger ml-auto" data-bootbox="delete" data-model="user" data-url="{{ url("api/admin/user/$user->slug") }}">Delete</button>
@endcan
