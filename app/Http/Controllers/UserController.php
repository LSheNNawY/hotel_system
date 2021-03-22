<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable -> render('users.index');
    }
}
