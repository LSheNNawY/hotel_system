<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ManagersDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('Actions', 'admin.Managers.actions')
            ->addColumn('avatar', function ($user) { $url=asset("storage/images/$user->avatar"); 
                return '<img src='.$url.' border="0" width="100" height="100" class="img-rounded" align="center" />'; })
            ->editColumn('approved', function ($user) {
                    return $user->approved ? '<span class="badge badge-primary">Approved</span>'
                        : '<span class="badge badge-danger">Un Approved</span>';
                })   
        
            ->rawColumns(['avatar','Actions','approved']);
;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ManagersDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()
            ->with('admin')
            ->select('users.*')

            ;
            // $users = User::with(['roles' => function($q){
            //     $q->where('name', 'admin');
            // }])->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Datatable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);                                   
    }

    /**
     * Get columns.
     *
     * @return array
     */
   protected function getColumns()
    {
        return [
            [
                'name' => 'name',
                'data' => 'name',
                'title' => 'Name'
            ],
            [
                'name' => 'email',
                'data' => 'email',
                'title' => 'Email'
            ],
            [
                'name' => 'national_id',
                'data' => 'national_id',
                'title' => 'National Id'
            ],
            [
                'name' => 'avatar',
                'data' => 'avatar',
                'title' => 'Avatar'
            ],
            [
                'name' => 'mobile',
                'data' => 'mobile',
                'title' => 'Mobile'
            ],
            [
                'name' => 'country',
                'data' => 'country',
                'title' => 'Country'
            ],
            [
                'name' => 'gender',
                'data' => 'gender',
                'title' => 'Gender'
            ],
            [
                'name' => 'approved',
                'data' => 'approved',
                'title' => 'Approved'
            ],
            [
                'name' => 'approved_by',
                'data' => 'admin.name',
                'title' => 'Approved By'
            ],
            Column::make('Actions'), 
        
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Managers_' . date('YmdHis');
    }
    
}

