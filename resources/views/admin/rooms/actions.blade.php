<a class="btn btn-xs btn-warning updateRoomBtn" title="update" value="{{ $id }}" data-url="{{ route('admin.rooms.edit', $id) }}" data-updateUrl="{{ route('admin.rooms.update', $id) }}" onclick="">
    <i class="fa fa-edit"></i>
</a>

<<<<<<< HEAD
<a class="btn btn-xs btn-danger deleteRoomBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.rooms.delete', $id) }}" data-datatable="#roomsDatatable">
=======
<a class="btn btn-xs btn-danger deleteRoomBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.rooms.destroy', $id) }}" data-datatable="#roomsDatatable">
>>>>>>> 93ef51f7f1a37b8099b5933a313fed3c5317a5a4
    <i class="fa fa-user-times"></i>
</a>