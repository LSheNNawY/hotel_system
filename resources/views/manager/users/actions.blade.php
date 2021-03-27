@if($approved == 0)
<a class="btn btn-xs btn-outline-success userApproveBtn" title="approve" value="{{ $id }}" data-datatable="#Datatable" data-url="{{ route('admin.users.edit', $id) }}" data-updateUrl="{{ route('admin.users.update', $id) }}" onclick="">
    <i class="fa fa-check"></i>
</a>
@endif

<a class="btn btn-xs btn-outline-danger deleteBtn" title="delete" value="{{ $id }}" data-url="{{ route('admin.users.destroy', $id) }}" data-datatable="#Datatable">
    <i class="fa fa-user-times"></i>
</a>
