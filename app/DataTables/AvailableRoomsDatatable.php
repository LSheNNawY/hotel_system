<?php

namespace App\DataTables;

use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Services\DataTable;

class AvailableRoomsDatatable extends DataTable
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
            ->addColumn('actions', 'client.rooms.actions')
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Room $model
     * @return Builder
     */
    public function query(Room $model)
    {
        return $model->newQuery()->select('rooms.*')->where('available', 1);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('AvailableDatatable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
                'name' => 'id',
                'data' => 'id',
                'title' => 'Room'
            ],
            [
                'name' => 'price',
                'data' => 'price',
                'title' => 'Price'
            ],
            [
                'name' => 'capacity',
                'data' => 'capacity',
                'title' => 'Capacity'
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
        return 'AvailableRooms_' . date('YmdHis');
    }
}
