<a class="btn btn-xs btn-warning updateManagerRoomBtn" title="update" value="{{ $id }}" data-url="{{ route('manager.rooms.edit', $id) }}" data-updateUrl="{{ route('manager.rooms.update', $id) }}" onclick="">
    <i class="fa fa-edit"></i>
</a>

<a class="btn btn-xs btn-danger deleteManagerRoomBtn" title="delete" value="{{ $id }}" data-url="{{ route('manager.rooms.destroy', $id) }}" data-datatable="#ManagerRoomsDatatable">
    <i class="fa fa-user-times"></i>
</a>