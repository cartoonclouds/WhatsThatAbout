<?php

namespace App\DataTables;

use App\Models\Page;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PagesDataTable extends DataTable
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

            ->editColumn('title', '{{$title}}')
            ->editColumn('release_year', function (Page $page) {
                return $page->release_year->format(config('website.formats.date'));
            })
            ->editColumn('runtime', '{{$runtime}}')

            ->addColumn('genre', function (Page $page) {
                return $page->genre->deleted ?? "<a href='{$page->genre->url}'>{$page->genre->name}</a>";
            })
            ->addColumn('format', function (Page $page) {
                return $page->format->deleted ?? "<a href='{$page->format->url}'>{$page->format->name}</a>";
            })
            ->addColumn('creator', function (Page $page) {
                return $page->creator->deleted ?? "<a href='{$page->creator->url}'>{$page->creator->username}</a>";
            })
            ->addColumn('scenes_count', '{{$scenes_count}}')
            ->addColumn('comments_count', '{{$comments_count}}')
            ->addColumn('votes', function (Page $page) {
                return "<i class='far fa-thumbs-up text-success'></i> {$page->votes()->upVotes()->count()}"
                    . "<br><i class='far fa-thumbs-down'></i> {$page->votes()->downVotes()->count()}";
            })
            ->addColumn('action', function (Page $page) {
                return view('pages.admin.action', compact('page'));
            })

            ->filterColumn('release_year', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(release_year, '%d/%m/%Y') LIKE ?", ["%$keyword%"]);
            })

            ->orderColumn('comments_count', '-comments_count $1')
            ->orderColumn('scenes_count', '-scenes_count $1')

            ->rawColumns(['genre', 'format', 'creator', 'votes'], true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Page $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Page $model)
    {
        return $model->newQuery()->with(['genre', 'format', 'creator']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pages-table')
                    ->addTableClass('table-hover')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1, 'asc')
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
            Column::make('id')->title('ID'),
            Column::make('title')->addClass('title'),
            Column::make('release_year'),
            Column::make('runtime'),
            Column::make('genre')->name('genre.name'),
            Column::make('format')->name('format.name'),
            Column::make('creator')->name('creator.username'),
            Column::make('scenes_count')->title('Associated Scenes'),
            Column::make('comments_count'),
            Column::make('votes')->orderable(false)->searchable(false),
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
        return 'Pages_' . date('YmdHis');
    }
}
