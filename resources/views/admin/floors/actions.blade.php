<a class="btn btn-xs btn-warning updateBtn" title="update" value="{{ $id }}"  data-url="" data-datatable="#floorsDatatable">
    <i class="fa fa-edit"></i>
</a>

<a class="btn btn-xs btn-danger deleteFloorBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.floors.delete', $id) }}" data-datatable="#floorsDatatable">
    <i class="fa fa-user-times"></i>
</a>