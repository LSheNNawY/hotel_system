<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\DataTables\ReceptionistsDatatable;


class ReceptionistsController extends Controller
{
    public function index(ReceptionistsDatatable $dataTable)
    { 
        $receptionists = User::with(['roles' => function($q){
        $q->where('name', 'admin');
         }])->get();
        return $dataTable->render('admin.receptionists.index',['title' => 'Receptionists', 'receptionists' => $receptionists]);
    }

    public function create(){

        return view('admin.receptionists.create');
    }

}



// public function create(){
//     return view('posts.create',[
//        'users'=>User::all()
//     ]);
// }