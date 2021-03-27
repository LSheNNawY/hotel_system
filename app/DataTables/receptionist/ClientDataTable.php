<?php

namespace App\DataTables\receptionist;

use App\Models\user;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientDataTable extends DataTable
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
            ->addColumn('Actions', 'receptionist.unapproved.actions')
            ->rawColumns(['Actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\receptionist/ClientDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()
        ->whereHas('roles', function ($q) {
            $q->where('id', '4');
        })
        ->where('approved',0)
        ->select('users.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $builder = $this->builder()
                    ->setTableId('Datatable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);

        if (auth()->user()->hasRole('receptionist')) {
            $builder->dom('Blfrtip')
                ->buttons([
                    ['extend' => 'print', 'className' => 'btn btn-sm btn-secondary mr-1', 'text' => '<i class="fa fa-print"></i> Print'],
                    ['extend' => 'excel', 'className' => 'btn btn-sm btn-success mr-1' , 'text' => '<i class="fa fa-file-excel"></i> Excel'],
                    ['extend' => 'reload', 'className' => 'btn btn-sm btn-info mr-1', 'text' => '<i class="fa fa-sync-alt"></i> Reload'],
                ]);
        }

        return $builder;
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
                'name' => 'mobile',
                'data' => 'mobile',
                'title' => 'mobile'
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
        return 'receptionist/Client_' . date('YmdHis');
    }
}
