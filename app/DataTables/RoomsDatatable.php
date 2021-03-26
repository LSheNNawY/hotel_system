<?php

namespace App\DataTables;

use App\Models\Room;
use Carbon\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class RoomsDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', 'admin.rooms.actions')
            ->editColumn('created_at', function ($room) {
                return $room->created_at ? with(new Carbon($room->created_at))->diffForHumans() : '';
            })
            ->editColumn('available', function ($room) {
                return $room->available ? '<span class="badge badge-primary">Available</span>'
                    : '<span class="badge badge-warning">Reserved</span>';
            })
            ->rawColumns(['actions'])
            ->escapeColumns('available');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Room $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()
            ->with('manager')
            ->select('rooms.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->setTableId('roomsDatatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->lengthMenu([[5, 10, 25, 50, -1], [5, 10, 25, 50, 'All']]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [

            [
                'name' => 'id',
                'data' => 'id',
                'title' => 'Room#'
            ],
            [
                'name' => 'capacity',
                'data' => 'capacity',
                'title' => 'Capacity'
            ],
            [
                'name' => 'price',
                'data' => 'price',
                'title' => 'Price'
            ],
            [
                'name' => 'available',
                'data' => 'available',
                'title' => 'Available'
            ],
            [
                'name' => 'created_by',
                'data' => 'manager.name',
                'title' => 'Created By'
            ],
            [
                'name' => 'floor_id',
                'data' => 'floor_id',
                'title' => 'Floor Number'
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
    protected function filename(): string
    {
        return 'Rooms_' . date('YmdHis');
    }
}
