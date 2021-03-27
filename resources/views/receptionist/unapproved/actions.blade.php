@if($approved == 0)
<a class="btn btn-xs btn-outline-success userApproveBtn" title="approve" value="{{ $id }}" data-datatable="#Datatable" data-url="{{ route('receptionist.clients.edit', $id) }}" data-updateUrl="{{ route('receptionist.clients.update', $id) }}" data-datatable="#Datatable" onclick="">
    <i class="fa fa-check"></i>
</a>
@endif