<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ManagersReceptionstsDataTable extends DataTable
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
            ->addColumn('Actions', 'manager.receptionists.actions')
            ->addColumn('avatar', function ($user) { $url=asset("storage/images/$user->avatar");
                return '<img src='.$url.' border="0" width="100" height="100" class="imges-rounded" align="center" />'; })
            ->editColumn('deleted_at', function ($user) {
                return $user->deleted_at == null ? '<span class="badge badge-success">Active</span>'
                    : '<span class="badge badge-danger">Banned</span>';
            })
            ->editColumn('approved', function ($user) {
                    return $user->approved ? '<span class="badge badge-primary">Approved</span>'
                        : '<span class="badge badge-danger">Un Approved</span>';
                })

            ->rawColumns(['avatar','Actions','approved', 'deleted_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ManagersReceptionstsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {

        // $users = User::with(['roles' => function($q){
        //     $q->where('name', 'receptionist');
        // }])->get()

        return $model->newQuery()
            ->with('manager')
            ->whereHas('roles', function ($q) {
                $q->where('id', '2');
            })
            ->withTrashed()
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
                    ->setTableId('ManagerDatatable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);

        if (auth()->user()->hasRole('admin|manager')) {
            $builder->dom('Blfrtip')
                ->buttons([
                    ['extend' => 'print', 'className' => 'btn btn-sm btn-secondary mr-1', 'text' => '<i class="fa fa-print"></i> Print'],
                    ['extend' => 'excel', 'className' => 'btn btn-sm btn-success mr-1' , 'text' => '<i class="fa fa-file-excel"></i> Excel'],
                    ['extend' => 'reload', 'className' => 'btn btn-sm btn-info mr-1', 'text' => '<i class="fa fa-sync-alt"></i> Reload'],
                    ['text' => '<i class="fa fa-plus"></i> New Receptionist', 'className' => 'btn btn-sm btn-success newReceptionistBtn'],
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
                'name' => 'national_id',
                'data' => 'national_id',
                'title' => 'National Id'
            ],
//            [
//                'name' => 'avatar',
//                'data' => 'avatar',
//                'title' => 'Avatar'
//            ],
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
                'name' => 'deleted_at',
                'data' => 'deleted_at',
                'title' => 'Status'
            ],
//            [
//                'name' => 'approved',
//                'data' => 'approved',
//                'title' => 'Approved'
//            ],
//            [
//                'name' => 'approved_by',
//                'data' => 'admin.name',
//                'title' => 'Approved By',
//                'defaultContent'=>'-'
//            ],
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
        return 'ManagersReceptionstsDatatale_' . date('YmdHis');
    }
}
