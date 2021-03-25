<a class="btn btn-xs btn-warning updateBtn" title="update" value="{{ $id }}" data-url="#" onclick="">
    <i class="fa fa-edit"></i>
</a>

<a class="btn btn-xs btn-danger deleteRoomBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.rooms.delete', $id) }}" data-datatable="#roomsDatatable">
    <i class="fa fa-user-times"></i>
</a>