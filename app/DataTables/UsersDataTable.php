<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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

            ->editColumn('banned', function (User $user) {
                return $user->banned ? '<i class="fas fa-user-alt-slash text-danger"></i>' : '<i class="fa fa-user-check text-success"></i>';
            })
            ->editColumn('name', '{{$name}}')
            ->editColumn('username', '{{$username}}')
            ->editColumn('email', '{{$email}}')
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format(config('website.formats.datetime'));
            })

            ->addColumn('email_verified', function (User $user) {
                return $user->email_verified_at ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-minus text-black-50"></i>';
            })
            ->addColumn('action', function (User $user) {
                return view('users.admin.action', compact('user'));
            })

            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at, '%d/%m/%Y') LIKE ?", ["%$keyword%"]);
            })

            ->orderColumn('email_verified', '-email_verified_at $1')

            ->rawColumns(['banned', 'email_verified'], true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1, 'asc')
                    ->orderBy(3, 'asc')
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('banned')->addClass('text-center'),
            Column::make('name')->addClass('title'),
            Column::make('username'),
            Column::make('email'),
            Column::make('email_verified')->addClass('text-center'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
