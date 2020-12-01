<?php

namespace App\DataTables;

use App\Models\Format;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FormatsDataTable extends DataTable
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

            ->editColumn('icon', function (Format $format) {
                return $format->icon ? "<img style='width:32px;height:auto;' src='$format->icon' />"
                    : '';
            })
            ->editColumn('name', '{{$name}}')

            ->addColumn('pages_count', '{{$pages_count}}')
            ->addColumn('action', function (Format $format) {
                return view('formats.admin.action', compact('format'));
            })

            ->rawColumns(['icon'], true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \\App\Models\Format $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Format $model)
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
                    ->setTableId('formats-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(2, 'asc')
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
            Column::make('icon')->width('40')->title('')->addClass('text-center vertical-align'),
            Column::make('id')->title('ID'),
            Column::make('name')->addClass('title'),
            Column::make('pages_count')->title('Associated Pages'),
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
        return 'Formats_' . date('YmdHis');
    }
}
