<a class="btn btn-xs btn-warning updateBtn" title="update" value="{{ $id }}" data-url="{{ route('admin.users.edit', $id) }}" data-updateUrl="{{ route('admin.users.update', $id) }}" onclick="">
    <i class="fa fa-edit"></i>
</a>


<a class="btn btn-xs btn-danger deleteBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.users.destroy', $id) }}" data-datatable="#Datatable">
    <i class="fa fa-user-times"></i>
</a>
