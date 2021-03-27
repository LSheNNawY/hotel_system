<?php

namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use App\DataTables\ManagersManagersDatatable;


class ManagersManagersController extends Controller
{
    public function index(ManagersManagersDatatable $dataTable)
    {
        return $dataTable->render('manager.managers.index', ['title' => 'Managers']);
    }

    public function create()
    {
//
    }

    public function store(Request $request)
    {
        //
        


       

    }

    public function edit($id)
    {
       
    }

    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */

    public function destroy($id)
    {
      //
    }

}
