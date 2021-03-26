<a class="btn btn-xs btn-warning updateRoomBtn" title="update" value="{{ $id }}" data-url="{{ route('admin.rooms.edit', $id) }}" data-updateUrl="{{ route('admin.rooms.update', $id) }}" onclick="">
    <i class="fa fa-edit"></i>
</a>

<<<<<<< HEAD
<a class="btn btn-xs btn-danger deleteRoomBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.rooms.delete', $id) }}" data-datatable="#roomsDatatable">
=======
<a class="btn btn-xs btn-danger deleteRoomBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.rooms.destroy', $id) }}" data-datatable="#roomsDatatable">
>>>>>>> cd5ced442fecf761ca8818006af0b62e8618ab8d
    <i class="fa fa-user-times"></i>
</a>