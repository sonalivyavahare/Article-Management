<?php

namespace App\DataTables;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ArticlesDataTable extends DataTable
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
            ->addColumn('feature_image', function ($article) {
                return '<img src="'.$article->feature_img.'" width="100" height="auto">';
            })
            ->addColumn('actions', function ($article) {
                return '<a href="articles/edit/'.$article->id.'" class="btn btn-sm btn-primary">Edit</a>&nbsp<button onclick="deleteRecord('.$article->id.', `articles/delete/'.$article->id.'`, `Are you sure, you want to delete this article?`,`articles-table`)" class="btn btn-sm btn-danger">Delete</button>';
            })->rawColumns(['feature_image', 'actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Article $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('articles-table')
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
            Column::make('title'),
            Column::make('slug'),
            Column::computed('feature_image'),
            Column::computed('actions')
                  ->exportable(false)
                  ->printable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Articles_' . date('YmdHis');
    }

    /**
     * Display the latest record first.
     */
    public function orderBy(QueryBuilder $query)
    {
        return $query->orderBy('id', 'desc');
    }

}
