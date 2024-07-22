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
            ->addColumn('check_box', function (Client $client) {
                return view(
                    'layouts.components._datatable-checkbox',
                    ['name' => "clients[]", 'value' => $client->id]
                );
            })
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
            ->addColumn('arrival_location_url', function(Client $model){
                return '<a target="_blank" href="'.$model->arrival_location_url.'"><i class="fa fa-map-o"></i></a>';
            })
            ->editColumn('chronic_disease', function(Client $model){
                return $model->chronic_disease ? "<img style='width:40px' class='img-responsive' src='".asset('images/disease.png')."'>" :  __('lang.no');
            })
            ->editColumn('supervisor_id', function(Client $model){
                return $model->supervisor?->name;
            })
            ->filterColumn('name', function($query, $keyword) {
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('phone', function($query, $keyword) {
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->where('phone', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['check_box', 'action', 'location', 'chronic_disease', 'arrival_location_url'])
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
            Column::make('check_box')->title('<label class="custom-control custom-checkbox custom-control-md">
            <input type="checkbox" class="custom-control-input checkAll">
            <span class="custom-control-label custom-control-label-md  tx-17"></span></label>')->searchable(false)->orderable(false),

            Column::make('id')->title(__('lang.id')),
            Column::make('name')->title(__('lang.name')),
            Column::make('phone')->title(__('lang.phone')),
            Column::make('reservation_number')->title(__('lang.reservation_number')),
            Column::make('package')->title(__('lang.package')),
            Column::make('launch_date')->title(__('lang.launch_date')),
            Column::make('seat_number')->title(__('lang.seat_number')),
            Column::make('gender')->title(__('lang.gender')),
            Column::make('identity_number')->title(__('lang.identity_number')),
            Column::make('location')->title(__('lang.location')),
            Column::make('arrival_location_url')->title(__('lang.arrival_location_url')),
            Column::make('country')->title(__('lang.country')),
            Column::make('city')->title(__('lang.city')),
            Column::make('chronic_disease')->title(__('lang.chronic_disease')),
            Column::make('chronic_disease_description')->title(__('lang.chronic_disease_description')),
            Column::make('supervisor_id')->title(__('lang.supervisor')),
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
        return 'Clients_' . date('YmdHis');
    }
}
