{{--<a class="btn btn-xs btn-warning updateBtn" title="update" value="{{ $id }}" data-url="{{ route('manager.receptionists.edit', $id) }}" data-updateUrl="{{ route('manager.receptionists.update', $id) }}" data-datatable="#ManagerDatatable">--}}
{{--    <i class="fa fa-edit"></i>--}}
{{--</a>--}}

@if($deleted_at == null)
    <a class="btn btn-xs btn-outline-warning banBtn" title="Ban"
       data-datatable="#ManagerDatatable" data-url="{{ route('manager.receptionists.update', $id) }}">
        <i class="fa fa-user-slash"></i>
    </a>
@else
    <a class="btn btn-xs btn-outline-success unbanBtn" title="Unban"
       data-datatable="#ManagerDatatable" data-url="{{ route('manager.receptionists.update', $id) }}">
        <i class="fa fa-user-check"></i>
    </a>
@endif

<a class="btn btn-xs btn-danger deleteBtn" title="delete" value="{{ $id }}"
   data-url="{{ route('admin.receptionists.destroy', $id) }}" data-datatable="#ManagerDatatable">
    <i class="fa fa-user-times"></i>
</a>


