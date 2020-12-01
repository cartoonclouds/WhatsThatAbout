<?php

namespace App\DataTables;

use App\Models\Scene;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ScenesDataTable extends DataTable
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

            ->addColumn('page', function (Scene $scene) {
                return $scene->page->deleted ?? "<a href='{$scene->page->url}'>{$scene->page->title}</a>";
            })
            ->addColumn('genre', function (Scene $scene) {
                return $scene->genre->deleted ?? "<a href='{$scene->genre->url}'>{$scene->genre->name}</a>";
            })
            ->addColumn('theme', function (Scene $scene) {
                return$scene->theme->deleted ?? "<a href='{$scene->theme->url}'>{$scene->theme->name}</a>";
            })
            ->addColumn('creator', function (Scene $scene) {
                return $scene->creator->deleted ?? "<a href='{$scene->creator->url}'>{$scene->creator->username}</a>";
            })
            ->addColumn('votes', function (Scene $scene) {
                return "<i class='far fa-thumbs-up text-success'></i> {$scene->votes()->upVotes()->count()}"
                        . "<br><i class='far fa-thumbs-down'></i> {$scene->votes()->downVotes()->count()}";
            })
            ->addColumn('comments_count', '{{$comments_count}}')
            ->addColumn('action', function (Scene $scene) {
                return view('scenes.admin.action', compact('scene'));
            })


            ->orderColumn('comments_count', '-comments_count $1')

            ->rawColumns(['runs_throughout', 'page', 'genre', 'theme', 'creator', 'votes'], true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \\App\Models\Scene $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Scene $model)
    {
        return $model->newQuery()->with(['page', 'genre', 'theme', 'creator']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('scenes-table')
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
            Column::make('page')->name('page.title'),//->orderable(false)->searchable(false),
            Column::make('genre')->name('genre.name'),
            Column::make('theme')->name('theme.name'),
            Column::make('creator')->name('creator.username'),
            Column::make('votes')->orderable(false)->searchable(false),
            Column::make('comments_count'),
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
        return 'Scenes_' . date('YmdHis');
    }
}
