<?php

namespace App\DataTables;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class ReservationsDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', function($reservation){
                return $reservation->approved_by ? '<a class="btn disapproveBtn" title="Disapprove" value="'. $reservation->id .'"
       data-url="ajax/disapprove/res/'. $reservation->id . '"
       data-updateUrl="ajax/disapprove/res/'. $reservation->id . '" data-datatable="#reservationsDatatable">
        <i class="fas fa-times-circle text-danger"></i>
    </a>' : '<a class="btn approveBtn" title="Approve" value="{{ $id }}" data-url="ajax/approve/res/'. $reservation->id . '"
       data-updateUrl="ajax/approve/res/'. $reservation->id . '"  data-datatable="#reservationsDatatable">
        <i class="fas fa-check-circle text-success"></i>
    </a>';
            })
            ->editColumn('created_at', function ($reservation) {
                return $reservation->created_at ? with(new Carbon($reservation->created_at))->diffForHumans() : '';
            })
            ->addColumn("approved", function ($reservation) {
                return $reservation->approved_by ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-danger">Pending</span>';
            })
            ->rawColumns(['actions'])
            ->escapeColumns('approved');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Reservation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Reservation $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()
            ->with(['room', 'client', 'manager'])
            ->select('reservations.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        $builder = $this->builder()
            ->setTableId('reservationsDatatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
        if (auth()->user()->hasRole('admin|manager')) {
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
    protected function getColumns(): array
    {
        return [

            [
                'name' => 'id',
                'data' => 'id',
                'title' => '#'
            ],
            [
                'name' => 'room_id',
                'data' => 'room.id',
                'title' => 'Room'
            ],
            [
                'name' => 'client_id',
                'data' => 'client.name',
                'title' => 'Client'
            ],
            [
                'name' => 'accompany_number',
                'data' => 'accompany_number',
                'title' => 'Accompany'
            ],
            [
                'name' => 'price_paid',
                'data' => 'price_paid',
                'title' => 'Paid'
            ],
            [
                'name' => 'approved',
                'data' => 'approved',
                'title' => 'Approved'
            ],
            [
                'name' => 'approved_by',
                'data' => 'manager.name',
                'title' => 'Approved By',
                'defaultContent' => '-'
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
        return 'Reservations_' . date('YmdHis');
    }
}
