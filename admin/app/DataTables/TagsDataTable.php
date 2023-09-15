<?php

namespace App\DataTables;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TagsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('actions', function ($tag) {
                return '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tagEditModal"><i class="fas fa-edit"></i></button>
                <button onclick="deleteRecord('.$tag->id.', `tags/delete/'.$tag->id.'`, `Are you sure, you want to delete this tag?`, `tags-table`)" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>';
            })->rawColumns(['actions']);
           /* <a href="tags/edit/'.$tag->id.'" class="btn btn-sm btn-primary">Edit</a>&nbsp */
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Tag $model): QueryBuilder
    {

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tags-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0, 'desc')
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::computed('actions')
                  ->title('Actions')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'tags_' . date('YmdHis');
    }
}
