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
    public function index(ClientDataTable $dataTable)
    {
        return $dataTable->render('receptionist.unapproved.index', ['title' => 'Un Approved Clients']);
    }

    // public function show(ApprovedClientsDatatable $dataTable)
    // {
    //     return $dataTable->render('receptionist.approved.index', ['title' => 'Approved Clients']);
    // }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $user=User::find($id);
            $user->update([
                'approved' => true,
                'approved_by' => auth()->user()->id
            ]);

            // send message to user after approval
            Notification::route('mail', $user->email)
                    ->notify(new UserApprovalNotify($user));

            return \response('success');
        }
    }


  
}
