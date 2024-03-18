<?php

namespace App\DataTables;

use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function(Client $model){
                return view('Dashboard.Clients.actions',compact('model'))->render();
            })
            ->addColumn('name', function(Client $model){
                return $model->user->name;
            })
            ->addColumn('phone', function(Client $model){
                return $model->user->phone;
            })
            ->addColumn('location', function(Client $model){
                return '<a target="_blank" href="https://www.google.com/maps/search/?api=1&query='.$model->user->lat.','.$model->user->lng.'"><i class="fa fa-map-o"></i></a>';
            })
            ->editColumn('supervisor_id', function(Client $model){
                return $model->supervisor->name;
            })
            ->rawColumns(['action', 'location'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ClientService $service): QueryBuilder
    {
        return $service->queryGet(filters: $this->filters, withRelations: $this->withRelations);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('clients-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
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
            Column::make('id'),
            Column::make('name'),
            Column::make('phone'),
            Column::make('reservation_number'),
            Column::make('reservation_status'),
            Column::make('package'),
            Column::make('launch_date'),
            Column::make('seat_number'),
            Column::make('gender'),
            Column::make('identity_number'),
            Column::make('location'),
            Column::make('country'),
            Column::make('city'),
            Column::make('supervisor_id')->title('supervisor'),
            Column::computed('action')
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
        return 'Clients_' . date('YmdHis');
    }
}
