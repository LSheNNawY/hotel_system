@if($deleted_at == null)
    <a class="btn btn-xs btn-outline-warning banBtn" title="Ban"
       data-datatable="#Datatable" data-url="{{ route('admin.receptionists.update', $id) }}">
        <i class="fa fa-user-slash"></i>
    </a>
@else
    <a class="btn btn-xs btn-outline-success unbanBtn" title="Unban"
       data-datatable="#Datatable" data-url="{{ route('admin.receptionists.update', $id) }}">
        <i class="fa fa-user-check"></i>
    </a>
@endif

<a class="btn btn-xs btn-danger deleteBtn" title="delete" value="{{ $id }}"
   data-url="{{ route('admin.receptionists.destroy', $id) }}" data-datatable="#Datatable">
    <i class="fa fa-user-times"></i>
</a>


