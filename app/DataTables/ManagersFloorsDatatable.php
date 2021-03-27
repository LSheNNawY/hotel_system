<?php

namespace App\DataTables;

use App\Models\Floor;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;


class ManagersFloorsDatatable extends DataTable
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
        ->addColumn('actions', 'manager.floors.actions')
        ->editColumn('created_at', function ($room) {
            return $room->created_at ? with(new Carbon($room->created_at))->diffForHumans() : '';
        })
        ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ManagersFloorsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Floor $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('managersFloorsDatatable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->lengthMenu([[5, 10, 25, 50, -1], [5, 10, 25, 50, 'All']])->dom('Blfrtip')
                    ->buttons([
                        ['extend' => 'print', 'className' => 'btn btn-sm btn-secondary mr-1', 'text' => '<i class="fa fa-print"></i> Print'],
                        ['extend' => 'excel', 'className' => 'btn btn-sm btn-success mr-1' , 'text' => '<i class="fa fa-file-excel"></i> Excel'],
                        ['extend' => 'reload', 'className' => 'btn btn-sm btn-info mr-1', 'text' => '<i class="fa fa-sync-alt"></i> Reload'],
                        ['text' => '<i class="fa fa-plus"></i> New Floor', 'className' => 'btn btn-sm btn-success newFloorBtn'],
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
                'name' => 'id',
                'data' => 'id',
                'title' => 'Floor#'
            ],
            [
                'name' => 'name',
                'data' => 'name',
                'title' => 'Name'
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => 'Created At'
            ],
            [
                'name' => 'actions',
                'data' => 'actions',
                'title' => 'Actions',
                'printable' => false,
                'exportable' => false,
                'searchable' => false,
                'orderable' => false,
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
        return 'ManagersFloors_' . date('YmdHis');
    }
}
