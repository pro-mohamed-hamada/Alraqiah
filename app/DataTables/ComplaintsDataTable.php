<?php

namespace App\DataTables;

use App\Models\Complaint;
use App\Services\ComplaintService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ComplaintsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function(Complaint $model){
                return view('Dashboard.Complaints.actions',compact('model'))->render();
            })
            ->addColumn('client', function(Complaint $model){
                return $model->user->name;
            })
            ->addColumn('phone', function(Complaint $model){
                return $model->user->phone;
            })
            ->editColumn('created_at', function(Complaint $model){
                return $model->created_at->format('Y-m-d h:i:s A');
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ComplaintService $service): QueryBuilder
    {
        return $service->queryGet(filters: $this->filters);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('complaints-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                        'pageLength' => 10,
                        "autoWidth" => true,
                        'columnDefs' => [
                            [ 'className'=> "text-center", "targets"=> "_all" ],
                        ],
                    ])
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title(__('lang.id')),
            Column::make('complaint')->title(__('lang.complaint')),
            Column::make('client')->title(__('lang.client')),
            Column::make('phone')->title(__('lang.phone')),
            Column::make('is_active')->title(__('lang.is_active')),
            Column::make('created_at')->title(__('lang.created_at')),
            Column::computed('action')
                ->title(__('lang.actions'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Complaints_' . date('YmdHis');
    }
}
