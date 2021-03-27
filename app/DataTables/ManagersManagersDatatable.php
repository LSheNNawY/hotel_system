<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class ManagersManagersDatatable extends DataTable
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
            ->addColumn('avatar', function ($user) {
                $url = asset("storage/images/$user->avatar");
                return '<img src=' . $url . ' border="0" width="100" height="100" class="imges-rounded" align="center" />';
            })
            ->editColumn('approved', function ($user) {
                return $user->approved ? '<span class="badge badge-primary">Approved</span>'
                    : '<span class="badge badge-danger">Un Approved</span>';
            })
            ->rawColumns(['avatar', 'approved']);;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ManagersManagersDatatale $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()
            ->whereHas('roles', function ($q) {
                $q->where('id', '2');
            })
            ->select('users.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
    return  $this->builder()
            ->setTableId('Datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)

            ->dom('Blfrtip')
                ->buttons([
                    ['extend' => 'print', 'className' => 'btn btn-sm btn-secondary mr-1', 'text' => '<i class="fa fa-print"></i> Print'],
                    ['extend' => 'excel', 'className' => 'btn btn-sm btn-success mr-1' , 'text' => '<i class="fa fa-file-excel"></i> Excel'],
                    ['extend' => 'reload', 'className' => 'btn btn-sm btn-info mr-1', 'text' => '<i class="fa fa-sync-alt"></i> Reload'],
                ]);
        

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
                'name' => 'mobile',
                'data' => 'mobile',
                'title' => 'Mobile'
            ],
            [
                'name' => 'country',
                'data' => 'country',
                'title' => 'Country'
            ],

         

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ManagersManagersDatatale_' . date('YmdHis');
    }
}
