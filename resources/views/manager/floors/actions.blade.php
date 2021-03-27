<a class="btn btn-xs btn-warning updateManagerBtn" title="update" value="{{ $id }}"  data-url="{{ route('manager.floors.edit', $id) }}" data-updateUrl="{{ route('manager.floors.update', $id) }}" data-datatable="#managersFloorsDatatable">
    <i class="fa fa-edit"></i>
</a>

<a class="btn btn-xs btn-danger deleteManagerFloorBtn" title="delete" value="{{ $id }}" data-url="{{ route('manager.floors.destroy', $id) }}" data-datatable="#managersFloorsDatatable">
    <i class="fa fa-user-times"></i>
</a>

