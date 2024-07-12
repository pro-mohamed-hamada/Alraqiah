<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.clients') }}</div>

        <div class="card-body">
            <div class="">
                @can('create_client')
                <a role="button" class="btn btn-primary " href="{{route('clients.create')}}"><i class="fa fa-plus"></i> {{__('lang.create_client')}}</a>
                @endif
                {{-- @can('import_client')
                <a role="button" class="btn btn-primary " href="{{route('clients.import_view')}}"><i class="fa fa-upload"></i> {{__('lang.import')}}</a>
                <a role="button" target="_blanck" class="btn btn-primary " href="{{asset('imports/Clients_with_relatives.xlsx')}}"><i class="fa fa-download"></i> {{__('lang.download_template')}}</a>
                @endif --}}
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        @can('import_client')
                        <li><a role="button" class="dropdown-item" href="{{route('clients.import_view')}}"><i class="fa fa-upload"></i> {{__('lang.import')}}</a></li>
                        <li><a role="button" class="dropdown-item" href="{{asset('imports/Clients_with_relatives.xlsx')}}"><i class="fa fa-download"></i> {{__('lang.download_template')}}</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li><a name="delete_multiple" class="dropdown-item" href={{ route('clients.delete_multiple') }}> {{__('lang.delete_multiple')}}</a></li>
                    </ul>
                </div>
            </div>

            <div class="datatable table-responsive">
                {!! $dataTable->table(['class' => 'table-data table table-bordered text-nowrap border-bottom']) !!}

            </div>

        </div>
    </div>
</div>
