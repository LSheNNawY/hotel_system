<a class="btn btn-xs btn-warning updateBtn" title="update" value="{{ $id }}"  data-url="{{ route('admin.floors.edit', $id) }}" data-updateUrl="{{ route('admin.floors.update', $id) }}" data-datatable="#floorsDatatable">
    <i class="fa fa-edit"></i>
</a>

<a class="btn btn-xs btn-danger deleteFloorBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.floors.destroy', $id) }}" data-datatable="#floorsDatatable">
    <i class="fa fa-user-times"></i>
</a>

