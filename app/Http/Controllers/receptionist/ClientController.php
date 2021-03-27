<?php

namespace App\Http\Controllers\receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\receptionist\ClientDataTable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserApprovalNotify;
use App\DataTables\receptionist\ApprovedClientsDatatable;
use App\Models\User;



class ClientController extends Controller
{
   public function show(ApprovedClientsDatatable $dataTable)
    {
        return $dataTable->render('receptionist.approved.index', ['title' => 'Approved Clients']);
    }
  
}
