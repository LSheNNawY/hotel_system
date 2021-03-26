<a class="btn btn-xs btn-warning updateRoomBtn" title="update" value="{{ $id }}" data-url="{{ route('admin.rooms.edit', $id) }}" data-updateUrl="{{ route('admin.rooms.update', $id) }}" onclick="">
    <i class="fa fa-edit"></i>
</a>

<a class="btn btn-xs btn-danger deleteRoomBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.rooms.destroy', $id) }}" data-datatable="#roomsDatatable">
    <i class="fa fa-user-times"></i>
</a>