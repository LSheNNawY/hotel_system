<?php

namespace App\DataTables;

use App\Models\Room;
use Carbon\Carbon;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class ManagersRoomsDataTable extends DataTable
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
            ->addColumn('actions', 'manager.rooms.actions')
            ->editColumn('created_at', function ($room) {
                return $room->created_at ? with(new Carbon($room->created_at))->diffForHumans() : '';
            })
            ->editColumn('available', function ($room) {
                return $room->available ? '<span class="badge badge-primary">Available</span>'
                    : '<span class="badge badge-warning">Reserved</span>';
            })
            ->editColumn('price', function ($room) {
                return '$' . $room->price / 100;
            })
            ->rawColumns(['actions'])
            ->escapeColumns('available');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ManagersRoomsDatatale $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()
            ->with('manager')
            ->with('floor')
            ->select('rooms.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): Builder
    {
        $builder =  $this->builder()
            ->setTableId('ManagerRoomsDatatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->lengthMenu([[5, 10, 25, 50, -1], [5, 10, 25, 50, 'All']]);

        if (auth()->user()->hasRole('admin|manager')) {
            $builder->dom('Blfrtip')
                ->buttons([
                ['extend' => 'print', 'className' => 'btn btn-sm btn-secondary mr-1', 'text' => '<i class="fa fa-print"></i> Print'],
                ['extend' => 'excel', 'className' => 'btn btn-sm btn-success mr-1' , 'text' => '<i class="fa fa-file-excel"></i> Excel'],
                ['extend' => 'reload', 'className' => 'btn btn-sm btn-info mr-1', 'text' => '<i class="fa fa-sync-alt"></i> Reload'],
                ['text' => '<i class="fa fa-plus"></i> New Room', 'className' => 'btn btn-sm btn-success newRoomBtn'],
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
        return   [

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
                'name' => 'floor_id',
                'data' => 'floor.name',
                'title' => 'Floor'
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
        return 'ManagersRoomsDatatale_' . date('YmdHis');
    }
}
